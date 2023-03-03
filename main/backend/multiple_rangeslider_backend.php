<?php
// Add a field in gravity form
if (class_exists('GF_Field')) {
    class MRSGF_Field_Rangeslider extends GF_Field {

        // Use for type of field
        public $type = 'Rangeslider';

        // Use for add a field title
        public function get_form_editor_field_title() { return esc_attr__( 'Rangeslider', 'multiple-range-slider-for-gravity-form' ); }

        // Use for get form editor button
        public function get_form_editor_button() {
            return array(
                'group' => 'advanced_fields',
                'text'  => $this->get_form_editor_field_title(),
                'onclick'   => "StartAddField('".$this->type."');",
            );
        }

        // Use for get form editor field settings
        function get_form_editor_field_settings() {
            return array(
                'label_setting',
                'description_setting',
                'slider_range',
                'Prefixvalue',
                'slider_position',
                'stepvalue',
                'slider_show',
                'range_show',
                'slider_styling',
                'slider_label',
                'slider_value_visibility',
                'label_placement_setting',
                'css_class_setting',
                'admin_label_setting',
                'default_value_setting',
                'visibility_setting',
                'prepopulate_field_setting',
                'conditional_logic_field_setting'           
            );
        }

        // Use for conditional logic supported
        function is_conditional_logic_supported() { return true; }

        // Use for get value submission
        function get_value_submission( $field_values, $get_from_post=true ) {
            if(!$get_from_post) {
                return $field_values;
            }
            return sanitize_text_field($_POST);
        } 

        // Use for get field input
        function get_field_input( $form, $value = '', $entry = null ) {
            $mrsgf_entry_detail = $this->is_entry_detail();
            $mrsgf_form_editor  = $this->is_form_editor();
            $mrsgf_form_id  = $form['id'];
            $mrsgfid       = intval( $this->id );
            $mrsgf_field_id = $mrsgf_entry_detail || $mrsgf_form_editor || $mrsgf_form_id == 0 ? "input_$mrsgfid" : 'input_' . $mrsgf_form_id . "_$mrsgfid";
            $mrsgf_atts['type'] = 'hidden';
            $mrsgf_size          = $this->size;
            $mrsgf_disabled_text = $mrsgf_form_editor ? "disabled='disabled'" : '';
            $mrsgf_class_suffix  = $mrsgf_entry_detail ? '_admin' : '';
            $mrsgf_class         = $this->type . ' ' .$mrsgf_size . $mrsgf_class_suffix;
            $mrsgf_instruction = '';
            $mrsgf_read_only   = '';
            $mrsgf_atts['Prefixvalue'] = $this->Prefixvalue;
            $mrsgf_atts['slider_show'] = $this->slider_show;
            $mrsgf_atts['range_show'] = $this->range_show;
            $mrsgf_atts['slider_styling'] = $this->slider_styling;
            $mrsgf_atts['min'] = $this->min;
            $mrsgf_atts['max'] = $this->max;
            $mrsgf_atts['slider_label']= $this->slider_label;
            $mrsgf_atts['slider_position'] = $this->slider_position;  
            $mrsgf_atts['stepvalue'] = $this->stepvalue;       


            if($mrsgf_atts['slider_styling']=="circles"){
                $mrsgf_class_name = "circles-slider";
               
            }else if($mrsgf_atts['slider_styling']=="scale"){
                $mrsgf_class_name = "scale-slider";
                 
            }else if($mrsgf_atts['slider_styling']=="rainbow"){ 
                $mrsgf_class_name = "rainbow-slider";
                   
            }else if($mrsgf_atts['slider_styling']=="modern_flat"){ 
                $mrsgf_class_name = "flat-slider";

            }else if($mrsgf_atts['slider_styling']=="double_labels"){ 
                $mrsgf_class_name = "double-label-slider";

            }else{
                $mrsgf_class_name = "slider-display";
            }

            if (!empty($value)) {
                $mrsgf_valueee = $value['input_'.$mrsgfid];
            }else{
                $mrsgf_valueee = '';
            }
                
                
            $mrsgfgr = "<div class='ginput_container'><div class='".$mrsgf_class_name."'   sliderposition='".$mrsgf_atts['slider_position']."'  step='".$mrsgf_atts['stepvalue']."'  prefix='".$mrsgf_atts['Prefixvalue']."'   slidershow='".$mrsgf_atts['slider_show']."' rangeshow='".$mrsgf_atts['range_show']."'  min='".$mrsgf_atts['min']."'  max='".$mrsgf_atts['max']."' label='".$mrsgf_atts['slider_label']."' ><input  name='input_".$mrsgfid."'  id='". $mrsgf_form_id."' value='".$mrsgf_valueee."' type='".$mrsgf_atts['type']."' value='".$mrsgf_valueee."'  /></div></div>";

            return $mrsgfgr;
        }
    }
    GF_Fields::register(new MRSGF_Field_Rangeslider() );
}


// use for gravity form field standard settings
add_action( 'gform_field_standard_settings', 'MRSGF_add_custom_field' , 10, 2 );
function MRSGF_add_custom_field( $position, $form_id ){      
    // retrieve the data earlier stored in the database or create it
    if ($position == 50) {
        ?> 
        <li class="slider_range field_setting">
            <label for="slider_range" class="section_label">
                   <?php esc_html_e('Range', 'multiple-range-slider-for-gravity-form'); ?>
            </label>
            <?php esc_html_e('min', 'multiple-range-slider-for-gravity-form'); ?>
            <input type="number" id="slider_range_min"  name="min" min="1"  onchange="SetFieldProperty('min', this.value);" /></br>
            <?php esc_html_e('max', 'multiple-range-slider-for-gravity-form'); ?>
            <input type="number" id="slider_range_max"  name="max" min="1"  onchange="SetFieldProperty('max', this.value);"/>
        </li>
        <li class="Prefixvalue field_setting">
            <label for="Prefixvalue" class="section_label">
                   <?php esc_html_e('Prefix', 'multiple-range-slider-for-gravity-form'); ?>
            </label>
            <input type="text" name="prefix" id="Prefixvalue"  onchange="SetFieldProperty('Prefixvalue', this.value);" />
        </li>
        <li class="slider_position field_setting">
            <label for="slider_position" class="section_label">
                   <?php esc_html_e('prefix position :', 'multiple-range-slider-for-gravity-form'); ?>
            </label>
            <?php esc_html_e('Left', 'multiple-range-slider-for-gravity-form'); ?>
            <input type="radio" class="gf_rs_radio" name="slider_position" value="left" onchange="SetFieldProperty('slider_position', this.value);" disabled=""/>
            <?php esc_html_e('Right', 'multiple-range-slider-for-gravity-form'); ?>
            <input type="radio" class="gf_rs_radio" name="slider_position" value="right" onchange="SetFieldProperty('slider_position', this.value);" disabled=""/>
            <label class="mrsfgf_comman_link"><?php echo __('Only available in ','multiple-range-slider-for-gravity-form');?> <a href="https://www.plugin999.com/plugin/multiple-range-slider-for-gravity-form/" target="_blank">Pro Version</a></label>
        </li>
        <li class="stepvalue field_setting">
            <label for="stepvalue" class="section_label">
                   <?php esc_html_e('Step :', 'multiple-range-slider-for-gravity-form'); ?>
            </label>
            <input type="number" id="stepvalue"  name="stepvalue"  onchange="SetFieldProperty('stepvalue', this.value);"/>
        </li>
        <li class="slider_show field_setting">
            <label for="slider_show" class="section_label">
                   <?php esc_html_e('slider display :', 'multiple-range-slider-for-gravity-form'); ?>
            </label>
            <?php esc_html_e('Single Edge Slider', 'multiple-range-slider-for-gravity-form'); ?>
            <input type="radio" class="gf_rs_radio"  name="sliderdisplay" value="single_slider"   onchange="SetFieldProperty('slider_show', this.value);" disabled=""/>
            <?php esc_html_e('Double Edge Slider', 'multiple-range-slider-for-gravity-form'); ?>
            <input type="radio" class="gf_rs_radio"  name="sliderdisplay" value="double_slider"  onchange="SetFieldProperty('slider_show', this.value);" disabled=""/>
            <label class="mrsfgf_comman_link"><?php echo __('Only available in ','multiple-range-slider-for-gravity-form');?> <a href="https://www.plugin999.com/plugin/multiple-range-slider-for-gravity-form/" target="_blank">Pro Version</a></label>
        </li>
        <li class="slider_styling field_setting">
            <label for="slider_styling" class="section_label">
                   <?php esc_html_e('Slider Styling :', 'multiple-range-slider-for-gravity-form'); ?>
            </label>
            <ul class="mrsgf_display_ul">
                 <li>
                    <?php esc_html_e('Simple', 'multiple-range-slider-for-gravity-form'); ?>
                    <input type="radio" class="gf_rs_radio" name="style_slide" value="Simple"  onchange="SetFieldProperty('slider_styling', this.value);"/>
                </li>
                <li>
                    <?php esc_html_e('Circles', 'multiple-range-slider-for-gravity-form'); ?>
                    <input type="radio" class="gf_rs_radio" name="style_slide" value="circles"   onchange="SetFieldProperty('slider_styling', this.value);"/>
                </li>
            </ul>
            <ul class="mrsgf_display_ul">
                <li>
                  <?php esc_html_e('Scale', 'multiple-range-slider-for-gravity-form'); ?>
                    <input type="radio" class="gf_rs_radio" name="style_slide" value="scale"  onchange="SetFieldProperty('slider_styling', this.value);"/>
                </li>
                <li>
                  <?php esc_html_e('Rainbow', 'multiple-range-slider-for-gravity-form'); ?>
                    <input type="radio" class="gf_rs_radio" name="style_slide" value="rainbow"  onchange="SetFieldProperty('slider_styling', this.value);"/>
                </li>
            </ul>
            <ul class="mrsgf_display_ul">
                <li>
                  <?php esc_html_e('Modern Flat', 'multiple-range-slider-for-gravity-form'); ?>
                    <input type="radio" class="gf_rs_radio" name="style_slide" value="modern_flat"  onchange="SetFieldProperty('slider_styling', this.value);"/>
                </li>
                <li>
                 <?php esc_html_e('Double Labels', 'multiple-range-slider-for-gravity-form'); ?>
                    <input type="radio" class="gf_rs_radio" name="style_slide" value="double_labels"  onchange="SetFieldProperty('slider_styling', this.value);"/>
                </li>
             </ul>
        </li>
         <li class="range_show field_setting">
            <label for="range_show" class="section_label">
                   <?php esc_html_e('range show :', 'multiple-range-slider-for-gravity-form'); ?>
            </label>
            <?php esc_html_e('Enable', 'multiple-range-slider-for-gravity-form'); ?>
            <input type="radio" class="gf_rs_radio" name="rangeshow" value="enable"   onchange="SetFieldProperty('range_show', this.value);"/>
            <?php esc_html_e('Disable', 'multiple-range-slider-for-gravity-form'); ?>
            <input type="radio" class="gf_rs_radio" name="rangeshow" value="disable"  onchange="SetFieldProperty('range_show', this.value);"/>
        </li>
        <li class="slider_label field_setting">
            <label for="slider_label" class="section_label">
                   <?php esc_html_e('Slider label :', 'multiple-range-slider-for-gravity-form'); ?>
            </label>
            <input type="input" id="slider_label"  name="slider_label"  onchange="SetFieldProperty('slider_label', this.value);" />
            <p>[<strong><?php esc_html_e('NOTE:', 'multiple-range-slider-for-gravity-form'); ?></strong><?php esc_html_e('if you add label and range-show enable so show label otherwise show range.and label add ', 'multiple-range-slider-for-gravity-form'); ?><strong><?php esc_html_e('(ex: sunday,monday,tuseday)', 'multiple-range-slider-for-gravity-form'); ?></strong><?php esc_html_e(' use to comma.]', 'multiple-range-slider-for-gravity-form'); ?></p>
        </li>
        <?php 
    }      
}


// use for admin field settings js
add_action('gform_editor_js', 'MRSGF_editor_script', 11, 2);
function MRSGF_editor_script() {
    ?>
    <script type='text/javascript'>
        jQuery(document).ready(function($) {
            jQuery(document).bind("gform_load_field_settings", function(event, field, form){
                jQuery("#slider_range_min").val(field["min"]);
                jQuery("#slider_range_max").val(field["max"]);
                jQuery("#slider_label").val(field["slider_label"]);
                jQuery("#Prefixvalue").val(field["Prefixvalue"]);
                jQuery("input[name=slider_position][value='left']").prop('checked', true);
                jQuery("#stepvalue").val(field["stepvalue"]);
                jQuery("input[name=sliderdisplay][value='single_slider']").prop('checked', true);
                jQuery("input[name=rangeshow][value=" + field["range_show"] + "]").prop('checked', true);
                jQuery("input[name=style_slide][value=" + field["slider_styling"] + "]").prop('checked', true);
            });
        });
    </script>
    <?php
}


// Use for set default values
add_action( 'gform_editor_js_set_default_values', 'MRSGF_set_default_values' );
function MRSGF_set_default_values(){
    ?>
    case "Rangeslider" :
        field.label = 'Range Slider';
        field.min = 1;
        field.max = 23;
        field.stepvalue = 4;
        field.Prefixvalue = '%';
        field.slider_position = 'right';
        field.slider_show = 'single_slider';
        field.range_show = 'enable';
        field.slider_styling = 'scale';
    break;
    <?php
}

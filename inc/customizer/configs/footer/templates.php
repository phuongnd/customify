<?php
class Customify_Builder_Footer_Templates
{
    public $id = 'footer_templates';

    function customize(){
        $section = 'footer_templates';
        $prefix = 'footer_templates_';

        $id ='footer';
        $theme_name  = wp_get_theme()->get( 'Name' );
        $option_name =  "{$theme_name}_{$id}_saved_templates";

        $saved_templates = get_option( $option_name );
        if ( ! is_array( $saved_templates ) ) {
            $saved_templates = array();
        }

        $saved_templates = array_reverse( $saved_templates );

        $n = count( $saved_templates );

        $html = '';
        $html .= '<span class="customize-control-title">'.__( 'Saved Templates', 'customify' ).'</span>';
        $html .= '<ul class="list-saved-templates '.( $n > 0 ? 'has-templates' : 'no-templates' ).'">';
        if ( count( $saved_templates ) > 0 ) {
            foreach ( $saved_templates as $key => $tpl ) {
                $tpl = wp_parse_args( $tpl, array(
                    'name' => '',
                    'data' => '',
                ) );
                if ( ! $tpl['name'] ) {
                    $name =  __( 'Untitled', 'customify' );
                } else {
                    $name = $tpl['name'] ;
                }
                $html .= '<li class="saved_template" data-control-id="'.esc_attr( $prefix.'save' ).'" data-id="'.esc_attr( $key ).'" data-data="'.esc_attr( json_encode( $tpl['data'] ) ).'">'.esc_html( $name ).' <a href="#" class="load-tpl">'.__( 'Load', 'customify' ).'</a><a href="#" class="remove-tpl">'.__( 'Remove', 'customify' ).'</a></li>';
            }
        }

        $html .= '<li class="no_template">'.__( 'No saved templates.', 'customify' ).'</li>';

        $html .= '</ul>';
        $html .= '</div>';

        return array(
            array(
                'name' => $section,
                'type' => 'section',
                'panel' => 'footer_settings',
                'priority' => 0,
                'title'          => __( 'Templates', 'customify' ),
            ),

            array(
                'name' => $prefix.'save',
                'type' => 'custom_html',
                'section' => $section,
                'theme_supports' => '',
                'title'       => __( 'Save Template', 'customify' ),
                'description' => '<div class="save-template-form"><input type="text" data-builder-id="footer" data-control-id="'.esc_attr( $prefix.'save' ).'" class="template-input-name change-by-js"><button class="button button-secondary save-builder-template" type="button">'.esc_html__( 'Save', 'customify' ).'</button></div>'.$html,
            ),
        );
    }
}

Customify_Customize_Layout_Builder()->register_item( 'footer', 'Customify_Builder_Footer_Templates' );
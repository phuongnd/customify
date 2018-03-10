<?php

class Customify_Builder_Item_Search_Icon
{
    public $id = 'search_icon'; // Required
    public $section = 'search_icon'; // Optional
    public $name = 'search_icon'; // Optional
    public $label = ''; // Optional

    /**
     * Optional construct
     *
     * Customify_Builder_Item_HTML constructor.
     */
    function __construct()
    {
        $this->label = __('Search Icon', 'customify');
    }

    /**
     * Register Builder item
     * @return array
     */
    function item()
    {
        return array(
            'name' => $this->label,
            'id' => $this->id,
            'col' => 0,
            'width' => '1',
            'section' => $this->section // Customizer section to focus when click settings
        );
    }

    /**
     * Optional, Register customize section and panel.
     *
     * @return array
     */
    function customize()
    {
        // Render callback function
        $fn = array($this, 'render');
        $selector = ".header-{$this->id}-item";
        $config = array(
            array(
                'name' => $this->section,
                'type' => 'section',
                'panel' => 'header_settings',
                'title' => $this->label,
            ),

            array(
                'name'            => $this->section . '_size',
                'type'            => 'slider',
                'device_settings' => true,
                'section'         => $this->section,
                'min'             => 5,
                'step'            => 1,
                'max'             => 100,
                'selector'        => "$selector svg",
                'css_format'      => 'height: {{value}}; width: {{value}};',
                'label'           => __( 'Size', 'customify' ),
            ),

            array(
                'name'            => $this->section . '_padding',
                'type'            => 'slider',
                'device_settings' => true,
                'section'         => $this->section,
                'min'             => 10,
                'step'            => 1,
                'max'             => 100,
                'selector'        => "$selector .search-icon",
                'css_format'      => 'padding: {{value}};',
                'label'           => __( 'Padding', 'customify' ),
            ),

            array(
                'name' => $this->section . '_styling',
                'type' => 'styling',
                'section' => $this->section,
                'css_format' => 'styling',
                'title' => __('Styling', 'customify'),
                'description' => __('Search icon styling', 'customify'),
                'selector' => array(
                    'normal' => "{$selector} .search-icon",
                    'hover' => "{$selector} .search-icon:hover",
                    'normal_box_shadow' => "{$selector} .search-icon",
                    'normal_text_color' => "{$selector} .search-icon",
                ),
                'fields' => array(
                    'normal_fields' => array(
                        'link_color' => false, // disable for special field.
                        'bg_cover' => false,
                        'bg_image' => false,
                        'bg_repeat' => false,
                        'padding' => false,
                        'margin' => false,
                    ),
                    'hover_fields' => array(
                        'link_color' => false,
                        'padding' => false,
                        'bg_cover' => false,
                        'bg_image' => false,
                        'bg_repeat' => false,
                        'border_radius' => false,
                    ), // disable hover tab and all fields inside.
                )
            ),

        );

        // Item Layout
        return array_merge($config, customify_header_layout_settings($this->id, $this->section));
    }

    /**
     * Optional. Render item content
     */
    function render()
    {

        //$align = sanitize_text_field( Customify_Customizer()->get_setting( $this->section.'_modal_align' ) );
        $align= '';

        echo '<div class="header-' . esc_attr($this->id) . '-item form-align-'.$align.' item--'.esc_attr( $this->id ).'">';
?>
<a class="search-icon" href="#">
    <svg aria-hidden="true" focusable="false" role="presentation" xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21">
        <path fill="currentColor" fill-rule="evenodd" d="M12.514 14.906a8.264 8.264 0 0 1-4.322 1.21C3.668 16.116 0 12.513 0 8.07 0 3.626 3.668.023 8.192.023c4.525 0 8.193 3.603 8.193 8.047 0 2.033-.769 3.89-2.035 5.307l4.999 5.552-1.775 1.597-5.06-5.62zm-4.322-.843c3.37 0 6.102-2.684 6.102-5.993 0-3.31-2.732-5.994-6.102-5.994S2.09 4.76 2.09 8.07c0 3.31 2.732 5.993 6.102 5.993z"></path>
    </svg>
    <span class="arrow-down"></span>
</a>
<div class="header-search-modal-wrapper">
    <form role="search" class="header-search-modal header-search-form" action="<?php echo home_url( '/' ); ?>">
        <label>
            <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
            <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search the site …', 'customify' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'customify' ) ?>" />
        </label>
        <button type="submit" class="search-submit" >
            <svg aria-hidden="true" focusable="false" role="presentation" xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21">
                <path fill="currentColor" fill-rule="evenodd" d="M12.514 14.906a8.264 8.264 0 0 1-4.322 1.21C3.668 16.116 0 12.513 0 8.07 0 3.626 3.668.023 8.192.023c4.525 0 8.193 3.603 8.193 8.047 0 2.033-.769 3.89-2.035 5.307l4.999 5.552-1.775 1.597-5.06-5.62zm-4.322-.843c3.37 0 6.102-2.684 6.102-5.993 0-3.31-2.732-5.994-6.102-5.994S2.09 4.76 2.09 8.07c0 3.31 2.732 5.993 6.102 5.993z"></path>
            </svg>
        </button>
    </form>
</div>
<?php
        echo '</div>';
    }
}

Customify_Customizer_Layout_Builder()->register_item('header', new Customify_Builder_Item_Search_Icon());

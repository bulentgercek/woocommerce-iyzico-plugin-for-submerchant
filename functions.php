<?php
/**
 * PortaMedya Enfold Functions
 */
/**
 * Varyasyonlu Ürün için yeni seçenek ekleme
 */
	// Varyasyon ayarlarını ayarla
	add_action( 'woocommerce_product_after_variable_attributes', 'variation_settings_fields', 10, 3 );
	// Varyasyon ayarlarını kaydet
	add_action( 'woocommerce_save_product_variation', 'save_variation_settings_fields', 10, 2 );
	// Varyasyonlar için yeni alanlar yarat
	function variation_settings_fields( $loop, $variation_data, $variation ) {
		// Yazı Alanı
		woocommerce_wp_text_input( 
			array( 
				'id'          => 'variable_submerchant_price[' . $variation->ID . ']', 
				'label'       => __( 'SubMerchant Price', 'woocommerce' ), 
				'placeholder' => '0',
				'desc_tip'    => 'true',
				'description' => __( 'Alt üye işyerine IBAN adresine gönderilmesi istenen tutar.', 'woocommerce' ),
				'value'       => get_post_meta( $variation->ID, 'variable_submerchant_price', true )
			)
		);
	}
	// Varyasyonlar için yaratılan alanları kaydet
	function save_variation_settings_fields( $post_id ) {
		// Yazı Alanı
		$text_field = $_POST['variable_submerchant_price'][ $post_id ];
		if( ! empty( $text_field ) ) {
			update_post_meta( $post_id, 'variable_submerchant_price', esc_attr( $text_field ) );
		}
	}
/**
 * Woocommerce Ürünleri için Genel Tab'a SubMerchantKey alanı ekleme
 */
	// Alanları Ekle
	add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );
	// Alanları kaydet
	add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );
	// Eklenecek alanları tanımla
	function woo_add_custom_general_fields() 
	{
		global $woocommerce, $post;

		echo '<div class="options_group">';
		// Metin alanı
		woocommerce_wp_text_input( 
				array( 
					'id'          => 'submerchant_key', 
					'label'       => __( 'SubMerchant Key', 'woocommerce' ), 
					'placeholder' => '',
					'desc_tip'    => 'true',
					'description' => __( 'Alt üye işyeri anahtarı.', 'woocommerce' ) 
				)
			);
		echo '</div>';

	}
	// Alanları kaydet
	function woo_add_custom_general_fields_save( $post_id ){
		// Yazı Alanı : submerchant_key
		$woocommerce_submerchant_key = $_POST['submerchant_key'];
		if( !empty( $woocommerce_submerchant_key ) )
			update_post_meta( $post_id, 'submerchant_key', esc_attr( $woocommerce_submerchant_key ) );
		
		// Yazı Alanı : submerchant_price
		$woocommerce_submerchant_price = $_POST['submerchant_price'];
		if( !empty( $woocommerce_submerchant_price ) )
			update_post_meta( $post_id, 'submerchant_key', esc_attr( $woocommerce_submerchant_price ) );
	}

?>
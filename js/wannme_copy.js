var wannmePartnerId = "0ecfnuoeqjb_lazg0mx4";
var wannmePrivateKey = "kn9ox4wr-j0k7j5matvtla-u5wfz_y";

jQuery('div.continuar').click(function(e){
	var mail=jQuery('.wannme_mail_layer input[name="email"]').val();
	if(mail == '' || mail.indexOf('@') < 0)
	{
		jQuery('.wannme_error').fadeIn();
	}
	else
	{
		jQuery('.wannme_mail_layer').fadeOut();
		var WannmeJSURL = "https://static.wannme.com/js/integration/wannme.min.js";
		(function(d) {
			var ref = d.getElementsByTagName('script')[0];
			var apiJs, apiJsId = 'WannmeApi-jssdk';
			if (d.getElementById(apiJsId)) return;
			apiJs = d.createElement('script');
			apiJs.id = apiJsId;
			apiJs.async = true;
			apiJs.src = WannmeJSURL;
			ref.parentNode.insertBefore(apiJs, ref);
		}(document));
	}
});

function wannmeReady() {
	var wannmePartnerId = "0ecfnuoeqjb_lazg0mx4";
	var wannmePrivateKey = "kn9ox4wr-j0k7j5matvtla-u5wfz_y";
	
	var mail=jQuery('.wannme_mail_layer input[name="email"]').val();
	var id_producto=jQuery('.post_id_custom').attr('post_id');
	mail=mail.replace('@','_at_');	
	var wannme_UID_wannme_create_cobro_1 = mail+'_'+id_producto+generateUID();
	var amount_html=jQuery('.single_block#financiar').attr('price_value');

	Wannme.createPayment(
		[
			{ 
				id: 'wannme-create-payment', 
				amount: amount_html, 
				checksum: SHA1(wannmePartnerId + wannmePrivateKey + amount_html + wannme_UID_wannme_create_cobro_1), 
				partnerReference1: wannme_UID_wannme_create_cobro_1, 
				partnerReference2: '' ,
				openIn: 'new',
				callbackUrl: 'https://www.academiadeltransportista.com/wp-json/at_rest_api/callback_wannme/',
				okUrl: 'https://www.academiadeltransportista.com/finalizar-compra-financiacion/?type=ok',
				koUrl: 'https://www.academiadeltransportista.com/finalizar-compra-financiacion/?type=ko'
			}
		]
	);
}
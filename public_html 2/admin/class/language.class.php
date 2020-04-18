<?php
class language{

function fetch($sql)
{
        $query = mysql_query($sql);
		$object = mysql_fetch_object($query);
		return $object;

}
function get_title($lang,$title_name)
{
  $db_set = $this->db_set($lang);
  $title = $title_name.$db_set;
  $sql = "select " .$title." c from web_settings where web_id=1" ;
  $row = $this->fetch($sql);
  return $row->c;
}





function db_set($lang)
{
 if($lang=="pt")
  $table_value = "_pt";
 else 
  $table_value = "";
return $table_value;
}


function home($lang)
{
if($lang=="pt") $title = "Casa";
else
 $title = "Home";
return  $title;
}
function phone($lang)
{
if($lang=="pt") $title = "Telefone";
else
 $title = "Phone";
return  $title;
}
function email($lang)
{
if($lang=="pt") $title = "O email";
else
 $title = "Email";
return  $title;
}
function menu($lang,$title)
{
if($lang=='pt')
{
  if($title=="home") 
   $value = "హోమ్";  
  if($title=="search") 
   $value = "శోధన రాజకీయవేత్త";   
  if($title=="info") 
   $value = "సమాచారం";  
  if($title=="central") 
   $value = "సెంట్రల్";  
  if($title=="state") 
   $value = "రాష్ట్ర";  
  if($title=="president") 
   $value = "అధ్యక్షుడు";  
  if($title=="pm") 
   $value = "ప్రధానమంత్రి";    
  if($title=="central_minister") 
   $value = "కేంద్ర మంత్రులు";
   if($title=="mp") 
   $value = "ఎంపీ"; 
    if($title=="election_commission") 
   $value = "ఎన్నికల కమిషన్ ఆఫ్ ఇండియా"; 
   if($title=="political_parties") 
   $value = "రాజకీయ పార్టీలు"; 
   if($title=="voters") 
   $value = "ఓటర్లు"; 
   if($title=="more_info") 
   $value = "మరింత సమాచారం"; 
   
 if($title=="gallery") 
   $value = "గ్యాలరీ";   
    
  if($title=="news") 
   $value = "వార్తలు";   
   if($title=="constituency") 
   $value = "నియోజకవర్గం";  
  if($title=="election_result") 
   $value = "ఎన్నిక మరియు ఫలితం";   
    if($title=="application_form") 
   $value = "అప్లికేషన్ ఫారం";  
   
    if($title=="bulk_sms") 
   $value = "బల్క్ SMS";  
     if($title=="voice_calls") 
   $value = "వాయిస్ కాల్స్";   
    if($title=="surveys") 
   $value = "సర్వేలు";  
     if($title=="all_political_needs") 
   $value = "అన్ని రాజకీయ అవసరాలు";  
   
    if($title=="quick_links") 
   $value = "త్వరిత లింకులు"; 
   if($title=="twitter_feed") 
   $value = "ట్విట్టర్ ఫీడ్";  
   if($title=="facebook_feed") 
   $value = "ఫేస్బుక్ ఫీడ్";  
   
   if($title=="search_politician") 
   $value = "శోధన రాజకీయవేత్త"; 
   if($title=="select_state") 
   $value = "రాష్ట్రం ఎంచుకోండి";  
   if($title=="select_district") 
   $value = "జిల్లా ఎంచుకోండి";   
   
if($title=="select_mandal") 
   $value = "మండల్ ఎంచుకోండి"; 
   
   
}
else
{
    if($title=="home") 
   $value = "Home";  
  if($title=="search") 
   $value = "Search Politician";   
  if($title=="info") 
   $value = "Info";  
  if($title=="central") 
   $value = "Central";  
   if($title=="state") 
   $value = "State";  
  if($title=="president") 
   $value = "President";  
  if($title=="pm") 
   $value = "PM";    
  if($title=="central_minister") 
   $value = "Central Minister";
   if($title=="mp") 
   $value = "MP's"; 
    if($title=="election_commission") 
   $value = "Election Commission Of India"; 
   if($title=="political_parties") 
   $value = "Political Parties"; 
   if($title=="voters") 
   $value = "Voters"; 
   if($title=="more_info") 
   $value = "More Info"; 
    if($title=="gallery") 
   $value = "Gallery";   
    if($title=="news") 
   $value = "News";  
    if($title=="constituency") 
   $value = "Constituency";  
    if($title=="election_result") 
   $value = "Election And Result";
      
 
     if($title=="application_form") 
   $value = "Application Form";  
     if($title=="bulk_sms") 
   $value = "Bulk SMS";  
     if($title=="voice_calls") 
   $value = "Voice Calls";   
    if($title=="surveys") 
   $value = "Surveys";  
     if($title=="all_political_needs") 
   $value = "All Political Needs";  
   
   
   if($title=="quick_links") 
   $value = "Quick Links"; 
   if($title=="twitter_feed") 
   $value = "Twitter Feed";  
   if($title=="facebook_feed") 
   $value = "Facebook Feed";  
   
   
   if($title=="search_politician") 
   $value = "Search Politician"; 
   if($title=="select_state") 
   $value = "Select State";  
   if($title=="select_district") 
   $value = "Select District";   
   
if($title=="select_mandal") 
   $value = "Select Mandal";  
       
   
   
   
   
}
return $value;
}

function get_url($lang,$title)
{
if($lang =="pt")
{
 if($title=="about") $url = "sobre-nos";
 if($title=="service") $url = "servicos";
  if($title=="category") $url = "categoria";
 if($title=="faq") $url = "perguntas-frequentes";
 if($title=="contact") $url = "contate-nos";
 if($title=="rate") $url = "taxa";
 if($title=="member") $url = "adesao";
 if($title=="news") $url = "noticia";
  if($title=="thankyou") 
   $value = "obrigado";  
 
 
 
}
else
{
 if($title=="about") $url = "about-us";
 if($title=="service") $url = "service";
   if($title=="category") $url = "category";
 if($title=="faq") $url = "faq";
 if($title=="contact") $url = "contact-us";
 if($title=="rate") $url = "rate";
 if($title=="member") $url = "membership";
 if($title=="news") $url = "news";
  if($title=="thankyou") 
   $value = "thankyou";  
}


return $url;
}

function get_member($lang,$title)
{
 if($lang=="pt")
 {
  if($title=="personal") 
   $value = "Dados Pessoais";
   if($title=="place_of_consumption") 
   $value = "Local de Consumo";
   if($title=="rates") 
   $value = "Tarifário";
   if($title=="invoicing") 
   $value = "Facturação";
   
   
   
  if($title=="proponent") 
   $value = "Cliente proponente";
  if($title=="promotional") 
   $value = "Código promocional";
  if($title=="name") 
   $value = "Nome";
  if($title=="address_place") 
   $value = "Morada do local de consumo igual à morada de facturação? ";
  if($title=="yes") 
   $value = "Sim";
  if($title=="no") 
   $value = "Não";
    if($title=="street") 
   $value = "Rua";
  if($title=="door_number") 
   $value = "Número da porta / bloco";
  if($title=="floor") 
   $value = "Piso / Fração";
  if($title=="cod_postcard") 
   $value = "Bacalhau. Cartão postal";
  if($title=="location") 
   $value = "Localização";
  if($title=="phone") 
   $value = "Telefone ";
  if($title=="mobile") 
   $value = "Telemovel ";
  if($title=="nif") 
   $value = "NIF";
  if($title=="cae") 
   $value = "CAE";
  if($title=="email") 
   $value = "E-mail";
  if($title=="personal_authorize") 
   $value = "Autorizo a Energia Plural a recolher os meus dados pessoais e a utilizá-los exclusivamente para efeitos de ações promocionais desenvolvidas pela Energia Plural.";
   
    if($title=="delivery") 
   $value = "Código do ponto de entrega ";
  if($title=="current_electricty") 
   $value = "Este local tem actualmente fornecimento de electricidade? ";
  if($title=="current_supplier") 
   $value = "Qual é o seu actual fornecedor de electricidade?";
  if($title=="holder") 
   $value = "O titular do contrato de electricidade é o mesmo do actual? ";
   
   
if($title=="benefit") 
   $value = "É beneficiário de tarifa social?  ";
  if($title=="social_identification") 
   $value = "Não. Identificação de Segurança Social";
  if($title=="tariff") 
   $value = "Escolha a tarifa que pretende contratar";
  if($title=="hourly_option") 
   $value = "Opção horária ";   
 if($title=="time_cycle") 
   $value = "Ciclo horário "; 
   if($title=="contracted_power") 
   $value = "Potência contratada "; 
   if($title=="accept") 
   $value = "Li e aceito as condições contratuais gerais da Energya Plural";  
 if($title=="energy") 
   $value = "Energia "; 
   
   if($title=="simple") 
   $value = "Simples "; 
    if($title=="bi_time") 
   $value = "Bi-Horário"; 
    if($title=="tri_time") 
   $value = "Tri-Horário - Energia TRI"; 
   
      if($title=="daily") 
   $value = "Diário"; 
    if($title=="weekly") 
   $value = "Semanal"; 
   
      if($title=="compliance") 
   $value = "Adesão à factura electrónica"; 
    if($title=="confirm_email") 
   $value = "Confirmar E-mail"; 
   if($title=="invoice_accept") 
   $value = "Li e aceito os termos e condições gerais da factura electrónica"; 
    if($title=="form_payment") 
   $value = "Forma de pagamento"; 
   
   if($title=="invoice_authorize") 
   $value = "Autorizo que a cobrança das facturas emitidas pela Energia Plural, ao abrigo do contrato de fornecimento a celebrar, seja efectuada através de débito directo na minha conta bancária com dados identificativos acima indicados."; 
    if($title=="nib_proof") 
   $value = "Comprovativo de Identificação (Cópia de CC, BI ou outro)"; 
   
   if($title=="identification_proof") 
   $value = "Cópia de uma factura actual (Facultativo)"; 
    if($title=="copy_current") 
   $value = "Copy of a current invoice (Optional)"; 
   
   if($title=="other_documents") 
   $value = "Outros Documentos (Facultativo)"; 
    if($title=="next") 
   $value = "Próximo"; 
      if($title=="prev") 
   $value = "Previous"; 
   
    
   
   if($title=="submit") 
   $value = "Confirmar adesão"; 
 
   
 }
 else
 {
  if($title=="personal") 
   $value = "Personal Data";
    if($title=="place_of_consumption") 
   $value = "Place of Consumption";
   if($title=="rates") 
   $value = "Rates";
   if($title=="invoicing") 
   $value = "Invoicing"; 
  if($title=="proponent") 
   $value = "Proponent Client";
  if($title=="promotional") 
   $value = "Promotional Code";
  if($title=="name") 
   $value = "Name";
  if($title=="address_place") 
   $value = "Address of the place of consumption equal to the address of billing?";
  if($title=="yes") 
   $value = "Yes";
  if($title=="no") 
   $value = "No";  
  if($title=="street") 
   $value = "Street";
  if($title=="door_number") 
   $value = "Door Number / Block";
  if($title=="floor") 
   $value = "Floor / Fraction";
  if($title=="cod_postcard") 
   $value = "Cod. Postcard";
  if($title=="location") 
   $value = "Location";
  if($title=="phone") 
   $value = "Phone";
  if($title=="mobile") 
   $value = "Mobile Phone";
  if($title=="nif") 
   $value = "NIF";
  if($title=="cae") 
   $value = "CAE";
  if($title=="email") 
   $value = "Email";
  if($title=="personal_authorize") 
   $value = "I authorize Energy Plural to collect my personal data and to use it exclusively for the purposes of promotional actions developed by Energy Plural.";
   
       if($title=="delivery") 
   $value = "Delivery point code ";
  if($title=="current_electricty") 
   $value = "Does this place currently have electricity? ";
  if($title=="current_supplier") 
   $value = "What is your current electricity supplier?";
  if($title=="holder") 
   $value = "Is the holder of the electricity contract the same as the present one?";
   
   
if($title=="benefit") 
   $value = "Do you benefit from a social rate? ";
  if($title=="social_identification") 
   $value = "No. Social Security Identification ";
  if($title=="tariff") 
   $value = "Choose the tariff you want to hire";
  if($title=="hourly_option") 
   $value = "Hourly option";   
 if($title=="time_cycle") 
   $value = "Time Cycle "; 
   if($title=="contracted_power") 
   $value = "Contracted power "; 
   if($title=="accept") 
   $value = "I have read and accept the general contractual conditions of Energy Plural";  
   
    if($title=="energy") 
   $value = "Energy "; 
   
    if($title=="simple") 
   $value = "Simple "; 
    if($title=="bi_time") 
   $value = "Bi-Time "; 
    if($title=="tri_time") 
   $value = "Tri-Time - Energy TRI "; 
   
     if($title=="daily") 
   $value = "Daily"; 
    if($title=="weekly") 
   $value = "Weekly"; 
   
   
   
   
   
   if($title=="compliance") 
   $value = "Compliance with electronic invoicing"; 
    if($title=="confirm_email") 
   $value = "Confirm Email"; 
   if($title=="invoice_accept") 
   $value = "I have read and accept the general terms and conditions of the electronic invoice"; 
    if($title=="form_payment") 
   $value = "Form of payment"; 
   
   if($title=="invoice_authorize") 
   $value = "I authorize the collection of the invoices issued by Energy Plural, under the supply agreement to be celebrated, be made through direct debit to my bank account with the identification data indicated above."; 
    if($title=="nib_proof") 
   $value = "Proof of the NIB (ATM Cashier or Netbanco Printing)"; 
   
   if($title=="identification_proof") 
   $value = "Proof of Identification (Copy of CC, BI or other)"; 
    if($title=="copy_current") 
   $value = "Copy of a current invoice (Optional)"; 
   
   if($title=="other_documents") 
   $value = "Other Documents (Optional)"; 
    if($title=="next") 
   $value = "Next"; 
   if($title=="prev") 
   $value = "Previous"; 
   if($title=="submit") 
   $value = "Finish";  
   
   
   
 }

return $value;
}

function get_site($lang, $title)
{
 if($lang=="pt")
 {
	 if($title=="breaking")
	  $value = "బ్రేకింగ్ న్యూస్";
	 if($title=="politician")
	  $value = "రాజకీయ";
	 if($title=="local_news")
	  $value = "స్థానిక వార్తలు";
	if($title=="continue_reading")
	  $value = "పఠనం కొనసాగించు";
	if($title=="24_news")
	  $value = "24h న్యూస్ ఫీడ్";
   if($title=="national_news")
	  $value = "జాతీయ వార్తలు"; 	   
 }
 else
 {
	 if($title=="breaking")
	 $value = "Breaking News";
	 if($title=="politician")
	  $value = "Politician";
	 if($title=="local_news")
	  $value = "Local News";
	 if($title=="continue_reading")
	  $value = "Continue reading"; 
	if($title=="24_news")
	  $value = "24h News Feed";  
	if($title=="national_news")
	  $value = "National News";  
 }
 return $value;
	
	
}


function get_profile($lang,$title)
{
 if($lang=="pt")
 {
  if($title=="biography")
   $value = "జీవిత చరిత్ర";
  if($title=="news")
   $value = "వార్తల్లో";  
   if($title=="event")
   $value = "ఈవెంట్";
    if($title=="photo_gallery")
   $value = "ఛాయాచిత్రాల ప్రదర్శన";
    if($title=="video_gallery")
   $value = "వీడియో గ్యాలరీ";
    if($title=="achievement")
   $value = "అచీవ్మెంట్";
    if($title=="social")
   $value = "సోషల్ ఇనిషియేటివ్స్"; 
    if($title=="contact")
   $value = "సంప్రదించండి";
   if($title=="quick_fact")
   $value = "త్వరిత వాస్తవాలు";
   
    if($title=="father_name")
   $value = "తండ్రి పేరు";
   if($title=="mother_name")
   $value = "తల్లి పేరు";
   if($title=="brother_name")
   $value = "బ్రదర్ పేరు";
   if($title=="sister_name")
   $value = "సోదరి పేరు";
   if($title=="state")
   $value = "రాష్ట్రం";
   if($title=="district")
   $value = "జిల్లా";
   if($title=="mandal")
   $value = "మండల";
   if($title=="city")
   $value = "నగరం / వీధి";
   if($title=="village")
   $value = "విలేజ్";
   if($title=="zip")
   $value = "జిప్";
   if($title=="party")
   $value = "పార్టీ";
   if($title=="party_name")
   $value = "పార్టీ పేరు";
   if($title=="page_like")
   $value = "పేజీ ఇష్టాలు";
   if($title=="rating")
   $value = "రేటింగ్స్";
   if($title=="social_contact")
   $value = "సోషల్ కాంటాక్ట్స్";
    if($title=="get_in_touch")
   $value = "అందుబాటులో ఉండు";
 }
 else
 {
  if($title=="biography")
   $value = "Biography";
  if($title=="news")
   $value = "In The News";
    if($title=="event")
   $value = "Event";
    if($title=="photo_gallery")
   $value = "Photo Gallery";
    if($title=="video_gallery")
   $value = "Video Gallery";
    if($title=="achievement")
   $value = "Achievement";
    if($title=="social")
   $value = "Social Initiatives";
    if($title=="contact")
   $value = "Contact";
    if($title=="quick_fact")
   $value = "Quick Facts";
   
   
   if($title=="father_name")
   $value = "Father name";
   if($title=="mother_name")
   $value = "Mother Name";
   if($title=="brother_name")
   $value = "Brother Name";
   if($title=="sister_name")
   $value = "Sister Name";
   if($title=="state")
   $value = "State";
   if($title=="district")
   $value = "District";
   if($title=="mandal")
   $value = "Mandal";
   if($title=="city")
   $value = "City /Street";
   if($title=="village")
   $value = "Village";
   if($title=="zip")
   $value = "Zip";
   if($title=="party")
   $value = "Party";
   if($title=="party_name")
   $value = "Party Name";
   if($title=="page_like")
   $value = "Page Likes";
   if($title=="rating")
   $value = "Ratings";
   if($title=="social_contact")
   $value = "Social Contacts";
    if($title=="get_in_touch")
   $value = "Get in Touch";
 }
 
 return $value;

}


##  END CLASS 
}

?>

<?php  
  include_once('tabs_alertas_session.php');
  @ini_set('session.cookie_httponly', 1);
  @ini_set('session.use_only_cookies', 1);
  @ini_set('session.cookie_secure', 0);
  session_start() ;
  class tabs_alertas_form_teste
  {
  function tabs_alertas_teste()
  {
      include("../_lib/lang/es.lang.php");
?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html> 
<HEAD>
 <title>tabs_alertas</title> 
 <META http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
</HEAD>
<body> 
<form name="Fedit" method=post 
               action="./" 
               target="_self"> 
<input type="hidden" name="nmgp_outra_jan" value="true"/>
<input type="hidden" name="nmgp_start" value="SC"/>
</form> 
<script language=JavaScript> 
  document.Fedit.submit(); 
</script> 
</body> 
</html> 
<?php
  }
 }
  $frm_teste = new tabs_alertas_form_teste();
  $frm_teste->tabs_alertas_teste();
?>

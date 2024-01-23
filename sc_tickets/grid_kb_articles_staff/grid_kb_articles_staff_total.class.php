<?php

class grid_kb_articles_staff_total
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;

   var $nm_data;

   //----- 
   function __construct($sc_page)
   {
      $this->sc_page = $sc_page;
      $this->nm_data = new nm_data("en_us");
      if (isset($_SESSION['sc_session'][$this->sc_page]['grid_kb_articles_staff']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['grid_kb_articles_staff']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_staff']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->articlesid = (isset($Busca_temp['articlesid'])) ? $Busca_temp['articlesid'] : ""; 
          $tmp_pos = (is_string($this->articlesid)) ? strpos($this->articlesid, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->articlesid))
          {
              $this->articlesid = substr($this->articlesid, 0, $tmp_pos);
          }
          $this->categoryid = (isset($Busca_temp['categoryid'])) ? $Busca_temp['categoryid'] : ""; 
          $tmp_pos = (is_string($this->categoryid)) ? strpos($this->categoryid, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->categoryid))
          {
              $this->categoryid = substr($this->categoryid, 0, $tmp_pos);
          }
          $this->articlesubject = (isset($Busca_temp['articlesubject'])) ? $Busca_temp['articlesubject'] : ""; 
          $tmp_pos = (is_string($this->articlesubject)) ? strpos($this->articlesubject, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->articlesubject))
          {
              $this->articlesubject = substr($this->articlesubject, 0, $tmp_pos);
          }
          $this->articlecontent = (isset($Busca_temp['articlecontent'])) ? $Busca_temp['articlecontent'] : ""; 
          $tmp_pos = (is_string($this->articlecontent)) ? strpos($this->articlecontent, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->articlecontent))
          {
              $this->articlecontent = substr($this->articlecontent, 0, $tmp_pos);
          }
          $this->articletypeid = (isset($Busca_temp['articletypeid'])) ? $Busca_temp['articletypeid'] : ""; 
          $tmp_pos = (is_string($this->articletypeid)) ? strpos($this->articletypeid, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->articletypeid))
          {
              $this->articletypeid = substr($this->articletypeid, 0, $tmp_pos);
          }
          $this->articleview = (isset($Busca_temp['articleview'])) ? $Busca_temp['articleview'] : ""; 
          $tmp_pos = (is_string($this->articleview)) ? strpos($this->articleview, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->articleview))
          {
              $this->articleview = substr($this->articleview, 0, $tmp_pos);
          }
          $this->votesqty = (isset($Busca_temp['votesqty'])) ? $Busca_temp['votesqty'] : ""; 
          $tmp_pos = (is_string($this->votesqty)) ? strpos($this->votesqty, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->votesqty))
          {
              $this->votesqty = substr($this->votesqty, 0, $tmp_pos);
          }
      } 
   }

   //---- 
   function quebra_geral()
   {
      global $nada, $nm_lang , $categoryid;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_staff']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_staff']['tot_geral'] = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_staff']['where_pesq']; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_staff']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_staff']['where_pesq']; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_staff']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_staff']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_kb_articles_staff']['contr_total_geral'] = "OK";
   } 

   function nm_conv_data_db($dt_in, $form_in, $form_out)
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT") {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT") {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "SC_FORMAT_REGION") {
           $this->nm_data->SetaData($dt_in, strtoupper($form_in));
           $prep_out  = (strpos(strtolower($form_in), "dd") !== false) ? "dd" : "";
           $prep_out .= (strpos(strtolower($form_in), "mm") !== false) ? "mm" : "";
           $prep_out .= (strpos(strtolower($form_in), "aa") !== false) ? "aaaa" : "";
           $prep_out .= (strpos(strtolower($form_in), "yy") !== false) ? "aaaa" : "";
           return $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", $prep_out));
       }
       else {
           nm_conv_form_data($dt_out, $form_in, $form_out);
           return $dt_out;
       }
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $str_highlight_ini = "";
      $str_highlight_fim = "";
      if(substr($nm_campo, 0, 23) == '<div class="highlight">' && substr($nm_campo, -6) == '</div>')
      {
           $str_highlight_ini = substr($nm_campo, 0, 23);
           $str_highlight_fim = substr($nm_campo, -6);

           $trab_campo = substr($nm_campo, 23, -6);
           $tam_campo  = strlen($trab_campo);
      }      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($tam_campo >= $cont2)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
   } 
function createMenuStructure($aOrder, &$aList, $sParent, $aLabels){
$_SESSION['scriptcase']['grid_kb_articles_staff']['contr_erro'] = 'on';
  
	foreach ($aOrder as $iCat => $aCats) {
	    $sMenuId = 'mid_' . $iCat;
	    $aList[] = array(
	                     'id'     => $iCat,
	                     'mid'    => $sMenuId,
	                     'label'  => $aLabels[$iCat],
	                     'parent' => $sParent,
	                    );
	
	    $this->createMenuStructure($aCats, $aList, $sMenuId, $aLabels);
	}

$_SESSION['scriptcase']['grid_kb_articles_staff']['contr_erro'] = 'off';
}
function getCategoriesTree(){
$_SESSION['scriptcase']['grid_kb_articles_staff']['contr_erro'] = 'on';
  
	$sSql = "SELECT categoryid,
	                categoryname,
	                categoryparent
	         FROM kb_categories";
	
	 
      $nm_select = $sSql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->ds_cat = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->ds_cat[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->ds_cat = false;
          $this->ds_cat_erro = $this->Db->ErrorMsg();
      } 

	
	if (false === $this->ds_cat )  { return false;   }
	elseif (empty($this->ds_cat )) { return array(); }
	else {
	    $aNewOrder = array();
	
	    foreach ($this->ds_cat  as $iCat => $aData) {
	        $this->insertCategory($aData, $aNewOrder, 0);
	    }
	
	    return $aNewOrder;
	}
$_SESSION['scriptcase']['grid_kb_articles_staff']['contr_erro'] = 'off';
}
function getCategoryLabels(){
$_SESSION['scriptcase']['grid_kb_articles_staff']['contr_erro'] = 'on';
  

	$sSql = "SELECT categoryid,
	                categoryname
	         FROM kb_categories";
	
	 
      $nm_select = $sSql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->ds_cat = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->ds_cat[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->ds_cat = false;
          $this->ds_cat_erro = $this->Db->ErrorMsg();
      } 

	
	if (false === $this->ds_cat )  { return false;   }
	elseif (empty($this->ds_cat )) { return array(); }
	else {
	    $aLabels = array();
	
	    foreach ($this->ds_cat  as $iCat => $aData) {
	        $aLabels[ $aData[0] ] = $aData[1];
	    }
	
	    return $aLabels;
	}
$_SESSION['scriptcase']['grid_kb_articles_staff']['contr_erro'] = 'off';
}
function insertCategory($aCat, &$aOrder, $iLevel){
$_SESSION['scriptcase']['grid_kb_articles_staff']['contr_erro'] = 'on';
  

	$iCatId     = $aCat[0];
	$sCatLabel  = $aCat[1];
	$iCatParent = $aCat[2];
	
	if (0 == $iLevel && 0 == $iCatParent) {
	    $aOrder[$iCatId] = array();
	}
	else {
	    foreach ($aOrder as $iIndex => $aList) {
	        if ($iIndex == $iCatParent) {
	            $aOrder[$iCatParent] [$iCatId] = array();
	        }
	        elseif (!empty($aOrder[$iIndex])) {
	            $this->insertCategory($aCat, $aOrder[$iIndex], $iLevel + 1);
	        }
	    }
	}

$_SESSION['scriptcase']['grid_kb_articles_staff']['contr_erro'] = 'off';
}
function getRatingStars($total,$qty){
$_SESSION['scriptcase']['grid_kb_articles_staff']['contr_erro'] = 'on';
  

	if(empty($total) || empty($qty)) return ' ';	
	$votes = (int)$total / $qty;
	$str_img = '';
	for($i=0;$i<$votes;$i++){
		$str_img .= "<img src='../_lib/img/star_icons20.gif' />";
	}
	return $str_img;
	

$_SESSION['scriptcase']['grid_kb_articles_staff']['contr_erro'] = 'off';
}
}

?>

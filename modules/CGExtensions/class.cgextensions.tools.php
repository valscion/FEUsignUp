<?php

class cgextensions_tools
{
  var $_module;

  function cgextensions_tools(&$mod)
  {
    $this->_module =& $mod;
  }

  /*
   * A Convenience function to redirect to an admin tab in the
   * defaultadmin action
   *
   * See Also:  SetCurrentTab
   */
  function RedirectToTab( $id, $tab = '', $params = '', $action = '' )
  {
    $parms = array();
    if( is_array( $params ) )
      {
	$parms = $params;
      }
    if( $tab == '' )
      {
	if( $this->_module->_current_tab )
	  {
	    $tab = $this->_module->_current_tab;
	  }
      }
    if( $tab != '' )
      {
	$parms['cg_activetab'] = $tab;
      }
    if( is_array($this->_module->_errormsg) && count($this->_module->_errormsg) )
      {
	$parms['cg_error'] = implode(':err:',$this->_module->_errormsg);
      }
    if( is_array($this->_module->_messages) && count($this->_module->_messages) )
      {
	$parms['cg_message'] = implode(':err:',$this->_module->_messages);
      }

    if( empty($action) ) $action = 'defaultadmin';
    $this->_module->Redirect( $id, $action, '', $parms, true );
  }

  /*
   * A convenience function for creating an <img> tag.
   */
  function CreateImageTag($image,$alt='',$width='',$height='',$class='',$addtext='')
  {
    $txt = "<img src=\"$image\"";
    if( $alt != '' )
      {
	$txt .= " alt=\"$alt\"";
	$txt .= " title=\"$alt\"";
      }
    if( $width != '' )
      {
	$txt .= " width=\"$width\"";
      }
    if( $height != '' )
      {
	$txt .= " height=\"$height\"";
      }
    if( $class != '' )
      {
	$txt .= " class=\"$class\"";
      }
    if( $addtext != '' )
      {
	$txt .= " $addtext";
      }
    $txt .= " />";
    return $txt;
  }


  /*
   * A convenience function to search for an image in certain preset 
   * directories
   */
  function DisplayImage($image,$alt='',$class='',$width='',$height='')
  {
    $config = cmsms()->GetConfig();

    // check image_directories first
    if( isset($this->_module->_image_directories) && 
	!empty($this->_module->_image_directories))
      {
	foreach( $this->_module->_image_directories as $dir )
	  {
	    $url = "$dir/$image";
	    $path = cms_join_path($config['root_path'],$url);

	    if( is_readable($path) )
	      {
		if( $this->_module->IsAdminAction() )
		  {
		    $url = "../$url";
		  }
		return $this->_module->CreateImageTag($url,$alt,$width,$height,$class);
	      }
	  }
      }

    $theme = cmsms()->variables['admintheme'];
    if( is_object($theme) ) 
      {
	// we're in the admin
	$txt = $theme->DisplayImage($image,$alt,$width,$height,$class);
      }
    else
      {
	// frontend
	$txt = $this->CreateImageTag($image,$alt,$width,$height,$class);
      }
    return $txt;
  }


  /*
   * A convenience function for creating a link with an image
   */
  function CreateImageLink($id,$action,$returnid,$contents,$image,
			   $params=array(),$classname='',
			   $warn_message='',$imageonly=true,
			   $inline=false,
			   $addtext='',$targetcontentonly=false,$prettyurl='')
  {
    if( $classname == '' ) $classname = 'systemicon';

    $txt = $this->__CreatePrettyLink($id,$action,$returnid,
				    $this->DisplayImage($image,$contents,$classname), 
				    $params, $warn_message, false, $inline, 
				    $addtext, $targetcontentonly, $prettyurl );
    if( $imageonly !== true )
      {
	$txt .= '&nbsp;';
	$txt .= $this->_module->CreateLink
	  ($id, $action, $returnid,
	   $contents, $params, $warn_message, false, 
	   $inline, $addtext, $targetcontentonly, 
	   $prettyurl );
      }
    return $txt;
  }
  

  /*
   * An overridable function for creating a pretty link
   */
  function __CreatePrettyLink($id, $action, $returnid='', $contents='', 
			      $params=array(), $warn_message='', 
			      $onlyhref=false, $inline=false, $addtext='', 
			      $targetcontentonly=false, $prettyurl='')
  {
    $config = cmsms()->GetConfig();

    $pretty = false;
    if( $config['assume_mod_rewrite'] === true ||
	$config['internal_pretty_urls'] === true )
      {
	$pretty = true;
      }

    $method_exists = method_exists($this->_module,'CreatePrettyLink');
    if( $pretty && ($returnid != '') && $method_exists )
      {
	// pretty urls are configured, we're not in an admin action
	// and the CreatePrettyLink method has been found.
	return $this->_module->CreatePrettyLink($id,$action,$returnid,
						$contents,$params,
						$warn_message,
						$onlyhref,$inline,$addtext,
						$targetcontentonly,$prettyurl);
      }
    else
      {
	
	return $this->_module->CreateLink($id,$action,$returnid,$contents,$params,$warn_message,
				 $onlyhref,$inline,$addtext,$targetcontentonly,$prettyurl);
      }
  }


  function _DisplayTemplateList( &$module, $id, $returnid, $prefix, 
				 $defaulttemplatepref, 
				 $active_tab, $defaultprefname,
				 $title, $info = '',$destaction = 'defaultadmin')
  {
    // we're gonna allow multiple templates here
    // but we're gonna prefix them all with something
    $smarty = cmsms()->GetSmarty();
    
    $falseimage1 = cmsms()->variables['admintheme']->DisplayImage('icons/system/false.gif','make default','','','systemicon');
    $trueimage1 = cmsms()->variables['admintheme']->DisplayImage('icons/system/true.gif','default','','','systemicon');
    $alltemplates = cge_template_utils::get_templates_by_prefix($module,$prefix,true);
    $rowarray = array();
    $rowclass = 'row1';

    foreach( $alltemplates as $onetemplate )
      {
// 	if( !preg_match("/^$prefix/", $onetemplate ) )
// 	  {
// 	    continue;
// 	  }
	
 	$tmp = $onetemplate;
	$row = new StdClass();
	$row->name = $this->_module->CreateLink( $id, 'edittemplate', $returnid,
						 $tmp, array('template' => $tmp,
							     'destaction' => $destaction,
							     'cg_activetab' => $active_tab,
							     'title'=>$title,
							     'info'=>$info,
							     'prefix'=>$prefix,
							     'modname'=>$module->GetName(),
							     'moddesc'=>$module->GetFriendlyName(),
							     'mode'=>'edit'));
	$row->rowclass = $rowclass;

	$default = ($module->GetPreference($defaultprefname) == $tmp) ? true : false;
	if( $default )
	  {
	    $row->default = $trueimage1;
	  }
	else
	  {
	    $row->default = $this->_module->CreateLink( $id, 'makedefaulttemplate', $returnid,
					       $falseimage1,
					       array('template'=>$tmp,
						     'destaction'=>$destaction,
						     'defaultprefname'=>$defaultprefname,
						     'modname'=>$module->GetName(),
						     'cg_activetab' => $active_tab));
	  }

	$row->editlink = $this->_module->CreateImageLink( $id,'edittemplate',$returnid,
						 $this->_module->Lang('prompt_edittemplate'),
						 'icons/system/edit.gif',
						 array ('template' => $tmp,
							'destaction'=>$destaction,
							'cg_activetab' => $active_tab,
							'prefix'=>$prefix,
							'title'=>$title,
							'info'=>$info,
							'modname'=>$module->GetName(),
							'moddesc'=>$module->GetFriendlyName(),
							'mode'=>'edit'));
	
	if( $default )
	  {
	    $row->deletelink = '&nbsp;';
	  }
	else
	  {
	    $row->deletelink = $this->_module->CreateImageLink( $id, 'deletetemplate', $returnid,
						       $this->_module->Lang('prompt_deletetemplate'),
						       'icons/system/delete.gif',
						       array ('template' => $onetemplate,
							      'prefix'=>$prefix,
							      'modname'=>$module->GetName(),
							      'destaction'=>$destaction,
							      'cg_activetab' => $active_tab),
						       '',
						       $this->_module->Lang('areyousure'));
	  }
	
	array_push ($rowarray, $row);
	($rowclass == "row1" ? $rowclass = "row2" : $rowclass = "row1");
      }
    
    $smarty->assign('parent_module_name',$module->GetFriendlyName());
    $smarty->assign('items', $rowarray );
    $smarty->assign('nameprompt', $this->_module->Lang('prompt_name'));
    $smarty->assign('defaultprompt', $this->_module->Lang('prompt_default'));
    $smarty->assign('newtemplatelink',
			  $this->_module->CreateImageLink( $id, 'edittemplate', $returnid,
						  $this->_module->Lang('prompt_newtemplate'),
						  'icons/system/newobject.gif',
						  array('prefix' => $prefix,
							'destaction' => $destaction,
							'cg_activetab' => $active_tab,
							'modname' => $module->GetName(),
							'moddesc'=>$module->GetFriendlyName(),
							'title'=>$title,
							'info'=>$info,
							'mode' => 'add',
							'defaulttemplatepref' => $defaulttemplatepref
							),'','',false));
    $smarty->assign($this->_module->CreateFormEnd());
    return $this->_module->ProcessTemplate('listtemplates.tpl');
  }
}

?>

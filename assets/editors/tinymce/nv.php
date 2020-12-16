<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Apr 10, 2010 10:08:08 AM
 */

if (!defined('NV_MAINFILE')) die('Stop!!!');

/**
 * nv_aleditor()
 *
 * @param mixed $textareaname
 * @param string $width
 * @param string $height
 * @param string $val
 * @return
 */
function nv_aleditor($textareaname, $width = '100%', $height = '450px', $val = '', $customtoolbar = '', $path = '', $currentpath = '')
{
    global $global_config, $module_upload, $module_data, $admin_info;
	 if (empty($path) and empty($currentpath)) {
            $path = NV_UPLOADS_DIR;
            $currentpath = NV_UPLOADS_DIR;

            if (!empty($module_upload) and file_exists(NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . date("Y_m"))) {
                $currentpath = NV_UPLOADS_DIR . '/' . $module_upload . '/' . date('Y_m');
                $path = NV_UPLOADS_DIR . '/' . $module_upload;
            } elseif (!empty($module_upload) and file_exists(NV_UPLOADS_REAL_DIR . '/' . $module_upload)) {
                $currentpath = NV_UPLOADS_DIR . '/' . $module_upload;
            }
        }
    $return = '<textarea style="width: ' . $width . '; height:' . $height . ';" id="' . $module_data . '_' . $textareaname . '" name="' . $textareaname . '">' . $val . '</textarea>';
   
        $return .= '<script type="text/javascript" src="' . NV_BASE_SITEURL . NV_EDITORSDIR . '/tinymce/tinymce.min.js?t=' . $global_config['timestamp'] . '"></script>';
		$return .= "<script type=\"text/javascript\">
            var dialogUrl = '" . NV_BASE_SITEURL . NV_ADMINDIR . "/index.php?" . NV_NAME_VARIABLE . "=upload&popup=1&path=" . $path . "&currentpath=" . $currentpath . "&popup=1&CKEditorFuncNum=0&langCode=vi&CKEditor=" . $module_data . "_" . $textareaname . "&fldr=" . $currentpath . "';
            $(document).ready(function(){
            var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;			
				tinymce.init({
					height: 500,					
					language: 'vi',
					language_url : '" . NV_BASE_SITEURL . NV_ASSETS_DIR ."/editors/tinymce/langs/vi.js',
				  selector: 'textarea#" . $module_data . "_" . $textareaname . "',
				  external_filemanager_path: '" . NV_BASE_SITEURL . NV_ADMINDIR . "/index.php?" . NV_NAME_VARIABLE . "=upload&popup=1&path=" . $path . "&currentpath=" . $currentpath . "&fldr=" . $currentpath . "',
				  images_upload_url: '" . NV_BASE_SITEURL . NV_ADMINDIR . "/index.php?" . NV_NAME_VARIABLE . "=upload&op=upload&editor=tinymce&path=" . $path. "',
				 external_plugins: { 
'filemanager' : '".NV_BASE_SITEURL . NV_EDITORSDIR . "/tinymce/filemanager.js'},

				  plugins: 'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons lineheight code quickbars',				
				  menubar: 'file edit view insert format tools table tc help',
				  toolbar: 'undo redo | bold italic underline strikethrough lineheight| fontselect fontsizeselect formatselect forecolor backcolor| alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons preview | insertfile image media pageembed template link anchor codesample | ltr rtl | showcomments addcomment fullscreen',
				  autosave_ask_before_unload: true,
				  autosave_interval: '30s',
				  autosave_restore_when_empty: false,
				  autosave_retention: '2m',
				  image_caption: true,	 
				  toolbar_mode: 'wrap',
				   quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
				   tinycomments_mode: 'embedded',
				   noneditable_noneditable_class: 'mceNonEditable',
				  lineheight_formats: '8pt 10pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 26pt 36pt'
				  
				});

            });
            
            </script>";
     
    return $return;
}

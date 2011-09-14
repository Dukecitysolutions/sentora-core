<?php

/**
 *
 * ZPanel - A Cross-Platform Open-Source Web Hosting Control panel.
 * 
 * @package ZPanel
 * @version $Id$
 * @author Bobby Allen - ballen@zpanelcp.com
 * @copyright (c) 2008-2011 ZPanel Group - http://www.zpanelcp.com/
 * @license http://opensource.org/licenses/gpl-3.0.html GNU Public License v3
 *
 * This program (ZPanel) is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
 
class module_controller {

	static function getZpanelOptions (){
	global $zdbh;
	$line = "";
		$sql = "SELECT COUNT(*) FROM x_settings WHERE so_usereditable_en = 'true'";
		if ($numrows = $zdbh->query($sql)) {
 			if ($numrows->fetchColumn() <> 0) {
			
				$sql = $zdbh->prepare("SELECT * FROM x_settings WHERE so_usereditable_en = 'true'");
	 			$sql->execute();
				
				while ($row = $sql->fetch()) {
					$line .= "<tr><th>".$row['so_name_vc']."</th><td><input style=\"width:300px;\" type=\"text\" name=\"".$row['so_name_vc']."\" value=\"".$row['so_value_tx']."\"></td></tr>";	
				}
				$line .= "<tr><td><input type=\"submit\" name=\"inSaveSystem\"value=\"Save Changes\"></td><td></td></tr>";
			}
		}	
	return $line;
	}
	
	static function doUpdateZpanelConfig(){
	global $zdbh;

		$sql = "SELECT COUNT(*) FROM x_settings WHERE so_usereditable_en = 'true'";
		if ($numrows = $zdbh->query($sql)) {
 			if ($numrows->fetchColumn() <> 0) {
			
				$sql = $zdbh->prepare("SELECT * FROM x_settings WHERE so_usereditable_en = 'true'");
	 			$sql->execute();
				
				while ($row = $sql->fetch()) {
					if ($controller->GetControllerRequest('FORM', $row['so_name_vc'])) {
						$sql = $zdbh->prepare("UPDATE x_settings SET so_value_tx = '". GetControllerRequest('FORM', $row['so_name_vc'])."' WHERE so_name_vc = '".$row['so_name_vc']."'");
	 					$sql->execute();		
					}
				}
			}
		}
	
	}
	



}

?>

<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: CGExtensions (c) 2008 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to provide useful functions
#  and commonly used gui capabilities to other modules.
# 
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# However, as a special exception to the GPL, this software is distributed
# as an addon module to CMS Made Simple.  You may not use this software
# in any Non GPL version of CMS Made simple, or in any version of CMS
# Made simple that does not indicate clearly and obviously in its admin 
# section that the site was built with CMS Made simple.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------
#END_LICENSE

class cge_browser extends Browser
{
  protected function bulkCheckRobot()
  {
    $bot_list = array("Teoma", "alexa", "froogle", "Gigabot", "inktomi",
		      "looksmart", "URL_Spider_SQL", "Firefly", "NationalDirectory",
		      "Ask Jeeves", "TECNOSEEK", "InfoSeek", "WebFindBot", "girafabot",
		      "crawler", "www.galaxy.com", "Googlebot", "Scooter", "Slurp",
		      "msnbot", "appie", "FAST", "WebBug", "Spade", "ZyBorg", "rabaz",
		      "Baiduspider", "Feedfetcher-Google", "TechnoratiSnoop", "Rankivabot",
		      "Mediapartners-Google", "Sogou web spider", "WebAlta Crawler");
    
    foreach( $bot_list as $bot )
    {
      if( stripos($this->getUserAgent(),$bot) !== false )
	{
	  $this->setRobot(true);
	  $this->setMobile(false);
	}
    }
  }

  
  /**
   * Is the browser an ipad.
   * @return boolean True if the browser is from an ipad.
   */
  public function is_iPad()
  {
    return ( $this->getBrowser() == Browser::BROWSER_IPAD );
  }


  protected function checkBrowseriPad() {
    if( parent::checkBrowserIpad() )
      {
	$this->setMobile(false);
      }
  }


  protected function checkBrowsers()
  {
    parent::checkBrowsers();

    // now add detection for more bots.
    if( !$this->isRobot() )
      {
	$this->bulkCheckRobot();
      }
  }
} // end of class

#
# EOF
#
?>
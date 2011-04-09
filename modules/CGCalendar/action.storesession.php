<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: Skeleton (c) 2008 
#      by Robert Allen (akrabat) and
#         Robert Campbell (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to allow displaying calendars,
#  and management and display of time based events.
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
if( !isset($gCms) ) exit;

$prefix = '';
if( isset($params['cal_key'] ) )
  {
    $prefix = trim($params['cal_key']);
  }
$passthru = 'cal_pt_';
if( isset($params['action']) )
  {
    unset($params['action']);
  }
foreach( $params as $key => $value )
{
  if( !startswith($key,$passthru) )
    {
      $this->session_put($prefix.$key,$value);
    }
}

$tmpparms = array();
foreach( $params as $key => $value )
{
  if( startswith($key,$passthru) )
    {
      $tmpparms[substr($key,strlen($passthru))] = $value;
    }
}

$url = $this->session_get($prefix.'redirect_url');
if( !empty($url) )
  {
    redirect($url);
  }
$this->Redirect($id,'default',$returnid,$tmpparams);

#
# EOF
#
?>
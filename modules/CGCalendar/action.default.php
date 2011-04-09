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

$display = get_parameter_value($params, 'display', 'calendar');
unset($this->langhash);

switch($display)
  {
  case 'calendar':
    {
      require_once(dirname(__FILE__).'/function.displaycalendar.php');
      DisplayCalendar($this,$id, $params, $returnid);
    }
    break;

  case 'event':
    {
      require_once(dirname(__FILE__).'/function.displayevent.php');
      DisplayEvent($this,$id, $params, $returnid);
    }
    break;

  case 'list':
    {
      require_once(dirname(__FILE__).'/function.displaylist.php');
      DisplayList($this, $id, $params, $returnid);
    }
    break;

  case 'yearlist':
    {
      require_once(dirname(__FILE__).'/function.displayyearlist.php');
      DisplayYearList($this, $id, $params, $returnid);
    }
    break;

  case 'pastlist':
    {
      require_once(dirname(__FILE__).'/function.displayupcominglist.php');
      $params['pastitems'] = 1;
      DisplayUpcomingList($this, $id, $params, $returnid);
    }
    break;

  case 'upcominglist':
    {
      require_once(dirname(__FILE__).'/function.displayupcominglist.php');
      DisplayUpcomingList($this, $id, $params, $returnid);
    }
    break;

  default:
    echo "Calendar: unknown display attribute '$display'!";
    break;
  }

?>

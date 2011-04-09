<?php

class cge_report
{
  private $_data = array();
  private $_types = array();

  public function add_row($rowdata,$key = '')
  {
    $this->_data[$key] = $rowdata;
  }

  public function set_types()
  {
    // this is a test.
  }
} // end of class

?>


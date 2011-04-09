<?php

interface feu_auth_consumer
{
  const CAPABILITY_LOGIN = 'CAPABILITY_LOGIN';
  const CAPABILITY_LOGOUT = 'CAPABILITY_LOGOUT';
  const CAPABILITY_CHANGESETTINGS = 'CAPABILITY_CHANGESETTINGS';
  const CAPABILITY_LOSTUSERNAME = 'CAPABILITY_LOSTUSERNAME';
  const CAPABILITY_FORGOTPASSWD = 'CAPABILITY_FORGOTPASSWD';
  const CAPABILITY_USESTDCHANGESETTINGS = 'CAPABILITY_USESTDCHANGESETTINGS';
  const CAPABILITY_CHANGEPASSWD = 'CAPABILITY_CHANGEPASSWD';

  const PROPERTY_USERNAME = '__USERNAME__';
  const PROPERTY_UID      = '__UID__';

  /**
   * Return a flag if the user is authenticated.
   */
  public function is_authenticated();

  /**
   * Return an array with this authentication methods capabilities
   *
   */
  public function get_capabilities();

  /**
   * Test if the consumer has the capability
   */
  public function has_capability($flag);

  /**
   * A function to display login informatio
   * (or a link to a login page)
   */
  public function get_login_display($id,$returnid,$params);

  /**
   * A function to display login information
   * (or a link to a login page)
   */
  public function get_logout_display($id,$returnid,$params);

  /**
   * A function to display the change settings page
   *
   */
  public function get_changesettings_display($id,$returnid,$params);


  /**
   * Get the user information from the external authentication system
   * for use by FEU 
   */
  public function get_user_info();


  /**
   * Get the name of an FEU property that is used to uniquely identify
   * a user 
   */
  public function get_connecting_property_name();


  /**
   * Get an identifier that uniquely identifies a user in this environment
   */
  public function get_unique_identifier();
}

?>
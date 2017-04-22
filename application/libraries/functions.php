<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Functions {
	protected $ci;
	protected $errors = array();

    public function __construct() {
        $this->ci =& get_instance(); 
    }

	function fieldNameAsText($fieldName) {
    $fieldName = str_replace("_", " ", $fieldName);
    $fieldName = ucfirst($fieldName);
    return $fieldName;
  }

  // * presence
  // use trim() so empty spaces don't count
  // use === to avoid false positives
  // empty() would consider "0" to be empty
  function hasPresence($value) {
    return isset($value) && $value !== "";
  }

  function validatePresences($requiredFields) {
    global $errors;
    foreach($requiredFields as $field) {
      $value = trim($_POST[$field]);
      if (!hasPresence($value)) {
        $errors[$field] = fieldNameAsText($field) . " can't be blank";
      }
    }
  }

  // * string length
  // max length
  function hasMaxLength($value, $max) {
    return strlen($value) <= $max;
  }

  function validateMaxLengths($fieldsWithMaxLengths) {
    global $errors;
    // Expects an assoc. array
    foreach($fieldsWithMaxLengths as $field => $max) {
      $value = trim($_POST[$field]);
      if (!hasMaxLength($value, $max)) {
        $errors[$field] = fieldNameAsText($field) . " is too long";
      }
    }
  }

  // * inclusion in a set
  function hasInclusionIn($value, $set) {
    return in_array($value, $set);
  }
	
    public function buildData()
    {
       $this->ci->load->model('m_user');
       $data['priv_information'] = $this->ci->m_user_group->get_priv_information(); 
       $data['priv_customer'] = $this->ci->m_user_group->get_priv_customer();   
       $data['priv_new_model'] = $this->ci->m_user_group->get_priv_new_model();  
       $data['priv_price'] = $this->ci->m_user_group->get_priv_price();    
       $data['priv_masspro'] = $this->ci->m_user_group->get_priv_masspro();    
       $data['priv_product'] = $this->ci->m_user_group->get_priv_product();
       $data['priv_calendar'] = $this->ci->m_user_group->get_priv_calendar();
       $data['priv_maintenance'] = $this->ci->m_user_group->get_priv_maintenance();

       return $data;
    }

}
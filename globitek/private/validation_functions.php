<?php

  // is_blank('abcd')
  function is_blank($value='') {
    // TODO
    return !isset($value) || trim($value) == '';
    //if not set doesn't exist so empty
    //trim strips whitespace and then is checked if any chars are in string
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    // TODO
    $len = strlen($value);
    if (isset($options['max']) && ($len > $options['max'])) {
      return false;
      //check len against max paramater
    } elseif(isset($options['min']) && ($len < $options['min'])){
      return false;
      //check len against min parameter
    } elseif(isset($options['exact']) && ($len != $options['exact'])){
      return false;
      //check len against exact param
    } else {
      return true;
    }
  }

  // has_valid_email_format('test@test.com')
  function has_valid_email_format($value) {
    // TODO
    if(filter_var($value, FILTER_VALIDATE_EMAIL)!= false){
      return true;
    } else {
      return false;
    }
  }

?>

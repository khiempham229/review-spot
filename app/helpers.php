<?php
function isNotEmpty($value)
{
  return isset($value) && !empty(trim($value));
}

function isNotEmptyFields(array $values)
{
  foreach ($values as $value) {
    if (!isset($value) || empty(trim($value))) {
      return false;
    }
  }
  return true;
}

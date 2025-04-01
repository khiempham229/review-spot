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

function statusLabel($status)
{
  switch ($status) {
    case 'pending':
      return 'Chưa kiểm duyệt';
    case 'approved':
      return 'Đã duyệt';
    case 'canceled':
      return 'Từ chối';
    default:
      return 'Không xác định';
  }
}

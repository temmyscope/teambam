<?php 
namespace App\Helpers;

use App\Providers\{Session, Request, Strings};

class HTML{

  /**
   * Prints HTML contents to view
   * functions @return void
  */

  public static function card($header = ''){
    return "<div class='card'><div class='card-header'>{$header}</div>".status()."<div class='card-body'>";
  }

  static public function closeCard(){
    echo "</div></div><br>";
  }

  public static function CsrfInput(){
    $csrf = Session::get('csrf');
    return "<br><input type='hidden' value='{$csrf}' name='csrf'>";
  }

  static public function paginate($perpage, $current=''){
    $page = Request::get('page');
    $current = ($current === true) ? true : $page;
    echo"<ul class='pagination' role='navigation'>";
    if($current == 1 || $current == null){
      echo"<li class='page-item'>
            <a class='page-link' href='?page=2' rel='next'>Next &raquo;</a>
      </li>";
    }elseif($current == 2){
      echo"<li class='page-item'>
            <a class='page-link' href='?page=1' rel='prev'>&laquo; Previous</a>
        </li><li class='page-item'>
            <a class='page-link' href='?page=3' rel='next'>Next &raquo;</a>
      </li>";
    }elseif ($current > 2) {
      $next = $current+1;
      $prev= $current -1;
      echo"<li class='page-item'>
            <a class='page-link' href='?page={$prev}' rel='prev'>&laquo; Previous</a>
        </li><li class='page-item'>
            <a class='page-link' href='?page={$next}' rel='next'>Next &raquo;</a>
      </li>";
    }elseif($current == true && $page != null){
      $var = $page - 1;
      echo"<li class='page-item'>
            <a class='page-link' href='?page={$var}' rel='next'>&laquo; Previous</a>
      </li>";
    }
    echo"</ul>";
  
  }

  public static function csrf(){
    $_SESSION["csrf"] = $_SESSION["csrf"] ?? Strings::fixed_length_token(32);
  }

  public static function generateForm(string $endpoint, array $form, $id='', $extras=''){
  /*-----------------------------------------------------------------------------------------------------------|
  |$form = [ 'name' => [ 'type' => , 'rule' => , 'placeholder' => , 'label' => , 'maxlength'=>, 'value' => ] ];|
  |------------------------------------------------------------------------------------------------------------*/
    $var = "<form method='post' action='".app()->get('APP_URL')."/{$endpoint}' enctype='multipart/form-data' accept-charset='UTF-8' 
    id='{$id}' {$extras}>".self::CsrfInput();

    foreach($form as $key => $value){
      $placeholder = (isset($value['placeholder'])) ? 'placeholder="'.$value['placeholder'].'"' : '';
      $rule = $value['rule'] ?? '';
      $label = $value['label'] ?? ucwords(str_replace('_', ' ', $key));
      $val = $value['value'] ?? '';
      $type = $value['type'] ?? 'text';
      $maxlength = (isset($value['maxlength']) && is_numeric($value['maxlength'])) ? "maxlength='".$value['maxlength']."'" : '';

      switch (strtolower($type)) {
        case 'email':
        case 'number':
        case 'text':
        case 'password':
        case 'file':
          $var .="<div class='form-group row'>
            <label for='{$type}' class='col-md-4 col-form-label text-md-right'> {$label}: </label>
            <div class='col-md-6'>
<input id='{$type}' type='{$type}' class='form-control' name='{$key}' {$placeholder} {$maxlength} {$rule} value='{$val}'>                        
            </div>
            </div>";     
          break;
        case 'hidden':
          $var .= "<input type='hidden' value='{$val}' name='{$key}'> ";
          break;
        case 'submit':
          $displayName = ucfirst($label);
          $var .= "<div class='form-group row'>
            <div class='col-md-8 offset-md-4'>
              <button type='submit' class='btn btn-primary' {$rule}> {$displayName} </button> 
            </div>
          </div>";
          break;
        case 'rememberme':
        case 'remember_me':
          $var .="<div class='form-group row'>
              <div class='col-md-6 offset-md-4'>
                  <div class='form-check'>
                      <input class='form-check-input' type='checkbox' name='remember_me' id='remember' >

                      <label class='form-check-label' for='remember'>
                          Remember Me
                      </label>
                  </div>
              </div>
          </div><br/>
          ";
          break;
        case 'textarea':
          $var .= "<div class='form-group row'>
            <label for='{$key}' class='col-md-4 col-form-label text-md-right'> {$label}: </label>
            <div class='col-md-6'><textarea name='{$key}' class='form-control' {$placeholder} {$rule}>{$val}</textarea></div>
          </div>";
          break;

        case 'checkbox':
        case 'radio':
          $var .="<div class='form-group row'>
            <label for='{$type}' class='col-md-4 col-form-label text-md-right'> {$label}: </label><div class='col-md-6'>";
            if (is_array($value['value'])) {
              foreach ($value['value'] as $k => $v) {
                $var .= "<input id='{$type}' type='{$type}' name='{$key}' value='{$v}' {$rule}>{$k} &nbsp;";
              }    
            }else{
                $var .= "<input id='{$type}' type='{$type}' name='{$key}' value='{$v}' {$rule}>{$k} &nbsp;";
            }                     
          $var .="</div>
            </div>";
          break;
        case 'select':
          $var .="<div class='form-group row'>
            <label for='{$type}' class='col-md-4 col-form-label text-md-right'> {$label}: </label>
            <div class='col-md-6'>
            <select name='{$key}' class='form-control' $rule>";
            if (is_array($value['value'])) {
              foreach ($value['value'] as $k => $v) {
                $var .= "<option id='{$type}' value='{$v}'> {$k} </option><br>";
              }    
            }                     
          $var .= "</select></div>
            </div>";
          break;
      }
    }
    return $var."</form>";
  }
}
?>
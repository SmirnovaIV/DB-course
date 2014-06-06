<?php
echo '<?xml version="1.0" encoding="utf-8"?>';?>
<result xmlns:xlink="http://www.w3.org/TR/xlink">
	<data><error code="<?php echo $v42552b1f133f9f8eb406d4f306ea9fd1->code;?>" type="<?php echo $v42552b1f133f9f8eb406d4f306ea9fd1->type;?>"><?php
   echo $v42552b1f133f9f8eb406d4f306ea9fd1->message;?></error><?php
  if (DEBUG_SHOW_BACKTRACE) :  ?><backtrace><?php
   foreach ($v42552b1f133f9f8eb406d4f306ea9fd1->trace as $vbb9e75cff599c7682f0ce64e530497de) :    ?><trace><?php
     echo $vbb9e75cff599c7682f0ce64e530497de;?></trace><?php
   endforeach;?></backtrace><?php
  endif;?></data>
</result>
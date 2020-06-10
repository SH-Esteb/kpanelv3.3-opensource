<?php

include('../class/include.php');

if (!Account::isAuthentified() || !CSRF::isAjaxRequest())

{
	http_response_code(403);
    die("Bad request");

}


$random_string_len = 15;
$line_break = false;


$code = str_replace("<NEWLINE>", "\n", $_POST['code']);
$endtbl = "local kPanel = {";

foreach (str_split($code) as $char) {
    $e = ord($char);
    $endtbl .= ($e ^ 2317) . ",";
}

$endtbl .= "0}";

?>RunString([[ <?php echo $endtbl; ?>

<?php echo 'local function Drmdontouch()if (debug.getinfo(function()end).short_src~="tenjznj")then return end for o=500,10000 do local t=0 if t==1 then return end  if o~=string.len(string.dump(Drmdontouch))then  AZE=10  CompileString("for i=1,40 do AZE = AZE + 1 end","RunString")()  if AZE<40 then return end continue  else  local pdata=""  xpcall(function()  for i=1,#kPanel do  pdata=pdata..string.char(bit.bxor(kPanel[i],2317))  end  for i=1,string.len(string.dump(CompileString)) do  while o==1 do  o=o+2  end  end  end,function()  xpcall(function()  local debug_inject=CompileString(pdata,"licence")  pcall(debug_inject,"stat")  pdata="F"  t=1  end,function()  print("An error as occured with the code")  end)  end)  end  end end Drmdontouch() ]],"tenjznj")';

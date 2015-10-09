<?php

class ini 
{
Function Read($IniFile, $IniKey, $IniVar, $defalut="Defalut txt") 
{
 if(substr($IniVar, 0,1) != ';')
 {
  if(file_exists($IniFile)) 
  {
    $this->Ini_Key = "[".strtolower($IniKey)."]";
    $this->Ini_Variable = strtolower($IniVar);
    $this->Ini_File = file($IniFile);
    unset($this->Ini_Value);
    for($Ini_Rec=0; $Ini_Rec<sizeof($this->Ini_File); $Ini_Rec++) 
    {
     $this->Ini_Temp = trim($this->Ini_File[$Ini_Rec]);
     $this->Ini_Tmp = strtolower($this->Ini_Temp);
     if ( substr_count($this->Ini_Tmp, "[") > 0 ) $this->Ini_Ready = 0; 
        
        if ( $this->Ini_Tmp == $this->Ini_Key ) $this->Ini_Ready = 1;
            If ( (substr_count($this->Ini_Tmp, "[") == 0) && ($this->Ini_Ready == 1) ) 
            {
              if (substr_count($this->Ini_Tmp, $this->Ini_Variable . "=") > 0) 
              {
               if ( substr($this->Ini_Temp, 0,1) != ';' ) 
               {
                   $this->Ini_Value = substr($this->Ini_Temp, strlen($this->Ini_Variable . "="));
                   $expl = explode(";",$this->Ini_Value);
                   if ( isset ( $expl[0] ) ) {
                    return $expl[0];
                   }
              }
             }
    }
}
    if ( $this->Ini_Ready == 1) 
    {
        $this->Ini_Value = $defalut;
                   $expl = explode(";",$this->Ini_Value);
                   if ( isset ( $expl[0] ) ) {
                    return $expl[0];
                   }
    }
    if ( !isset($this->Ini_Value) ) 
    {
        return "ERROR: Key: [<b>".strtoupper($IniKey)."</b>], does not exist in <b>".strtoupper($IniFile)."</b> file !"; // Key or Variable NOT FOUND in INI file
    }
}
else
{
 return "ERROR ini \"".$IniFile."\" does not exists!";
}
}
}
}

?>
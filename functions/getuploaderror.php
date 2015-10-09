<?php

function getuploaderror($code)
{
  switch ($code)
  {
    case 'UPLOAD_ERR_OK':
    case 0:
      return 'Er zijn geen fouten opgetreden';
    break;

    case 'UPLOAD_ERR_INI_SIZE':
    case 1:
      return 'Het bestand is groter dan de ingestelde waarde voor upload_max_file in php.ini';
    break;
    
    case 'UPLOAD_ERR_FORM_SIZE':
    case 2:
      return 'Het bestand is groter dan de in de HTML opgegeven MAX_FILE_SIZE waarde';
    break;
    
    case 'UPLOAD_ERR_PARTIAL':
    case 3:
      return 'Het bestand is niet geheel geupload';
    break;
    
    case 'UPLOAD_ERR_NO_FILE':
    case 4:
      return 'Er is geen bestand geupload ';
    break;

    case 'UPLOAD_ERR_NO_TMP_DIR':
    case 6:
      return 'kon de directory voor het tijdelijke bestand niet vinden.';
    break;
    
    case 'UPLOAD_ERR_CANT_WRITE':
    case 7:
      return 'kon het tijdelijke bestand niet wegschrijven';
    break;
  }
}

?>
<?php

function getStandardPort($scheme)
    {
        switch (strtolower($scheme)) 
        {
            case 'echo':     return    7;
            case 'daytime':  return   13;
            case 'ftpd':     return   20;
            case 'ftp':      return   21;
            case 'ftpc':     return   21;
            case 'ssh':      return   22;
            case 'telnet':   return   23;
            case 'smtp':     return   25;           
            case 'dns':      return   53;
            case 'http':     return   80;
            case 'kerberos': return   88;
            case 'pop3':     return  110;
            case 'nbns':     //See_Down.;
            case 'netbios':  //See_Down.;
            case 'nbn':      return  137;
            case 'imap':     return  143;
            case 'ldap':     return  389;
            case 'https':    return  443;
            case 'sftp':     return  990;
            case 'imaps':    return  993;
            case 'pop3s':    return  995;
            case 'msn':      //See_Down.;
            case 'wlm':      return 1863;
            case 'mqsql':    return 3306;
            case 'remote':   return 7539;
            case 'irc':      return 6667;          
            default:         return null;
       }
    }

?>
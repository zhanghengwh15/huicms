<?php

class Pager extends Page{
    
    public function __construct($totalRows, $listRows = '', $parameter = '', $url = '') {
        parent::__construct($totalRows, $listRows, $parameter, $url);
    }
    
    public function newshow() {
        if(0 == $this->totalRows) return '';
        $p              =   $this->varPage;
        $nowCoolPage    =   ceil($this->nowPage/$this->rollPage);
        // 分析分页参数
        if($this->url){
            $depr       =   C('URL_PATHINFO_DEPR');
            $url        =   rtrim(U('/'.$this->url,'',false),$depr).$depr.'__PAGE__';
        }else{
            if($this->parameter && is_string($this->parameter)) {
                parse_str($this->parameter,$parameter);
            }elseif(empty($this->parameter)){
                unset($_GET[C('VAR_URL_PARAMS')]);
                if(empty($_GET)) {
                    $parameter  =   array();
                }else{
                    $parameter  =   $_GET;
                }
            }
            $parameter[$p]  =   '__PAGE__';
            $url            =   U('',$parameter);
        }
        //上下翻页字符串
        $upRow          =   $this->nowPage-1;
        $downRow        =   $this->nowPage+1;
        if ($upRow>0){
            $upPage     =   "<li><a class='demo' href='".str_replace('__PAGE__',$upRow,$url)."'><span>".$this->config['prev']."</span></a></li>";
        }else{
            $upPage     =   '';
        }

        if ($downRow <= $this->totalPages){
            $downPage   =   "<li><a class='demo' href='".str_replace('__PAGE__',$downRow,$url)."'><span>".$this->config['next']."</span></a></li>";
        }else{
            $downPage   =   '';
        }
        // << < > >>
        if($nowCoolPage == 1){
            $theFirst   =   '';
            $prePage    =   '';
        }else{
            $preRow     =   $this->nowPage-$this->rollPage;
            $prePage    =   "<li><a class='demo' href='".str_replace('__PAGE__',$preRow,$url)."' ><span>上".$this->rollPage."页</span></a>";
            $theFirst   =   "<li><a class='demo' href='".str_replace('__PAGE__',1,$url)."' ><span>".$this->config['first']."</span></a></li>";
        }
        if($nowCoolPage == $this->coolPages){
            $nextPage   =   '';
            $theEnd     =   '';
        }else{
            $nextRow    =   $this->nowPage+$this->rollPage;
            $theEndRow  =   $this->totalPages;
            $nextPage   =   "<li><a class='demo' href='".str_replace('__PAGE__',$nextRow,$url)."' ><span>下".$this->rollPage."页</span></a></li>";
            $theEnd     =   "<li><a class='demo' href='".str_replace('__PAGE__',$theEndRow,$url)."' ><span>".$this->config['last']."</span></a></li>";
        }
        // 1 2 3 4 5
        $linkPage = "";
        for($i=1;$i<=$this->rollPage;$i++){
            $page       =   ($nowCoolPage-1)*$this->rollPage+$i;
            if($page!=$this->nowPage){
                if($page<=$this->totalPages){
                    $linkPage .= "<li><a class='demo' href='".str_replace('__PAGE__',$page,$url)."'><span>".$page."</span></a></li>";
                }else{
                    break;
                }
            }else{
                if($this->totalPages != 1){
                    $linkPage .= "<li><span class='currentpage'>".$page."</span></li>";
                }
            }
        }
//        echo "<pre>";print_r($pageStr);exit;
        $pageStr     =   str_replace(
            array('%header%','%nowPage%','%totalRow%','%totalPage%','%upPage%','%downPage%','%first%','%prePage%','%linkPage%','%nextPage%','%end%'),
            array($this->config['header'],$this->nowPage,$this->totalRows,$this->totalPages,$upPage,$downPage,$theFirst,$prePage,$linkPage,$nextPage,$theEnd),$this->config['theme']);
        
        return $pageStr;
    }
    
}

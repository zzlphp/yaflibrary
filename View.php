<?php
/**
 * 视图引擎定义
 * Created by PhpStorm.
 * User: ziziliang
 * Date: 2017/5/5
 * Time: 下午2:55
 */
// 基础模板类，被视图引擎引用
class dwzTemplate extends Blitz
{
    public function __construct()
    {
        parent::__construct();
        //construct class
    }

    public function dateFormat($timestamp, $format = 'Y-m-d H:i:s')
    {
        return date($format, $timestamp);
    }
    public function  getTodayDate($formate='Y-m-d'){
        return date($formate,time());
    }

    public function loadCss($files, $http)
    {
        $html = '';
        if (!empty($files))
        {
            $arr = explode(',', $files);
            foreach ($arr as $css)
            {
                $css = trim($css);
                if (!empty($css))
                {
                    $html .= "<link rel=\"stylesheet\" href=\"{$http}css/{$css}.css?t=4.1.8\" type=\"text/css\" />\r\n";
                }
            }
        }
        return $html;
    }

    public function loadJs($files, $http)
    {
        $html = '';
        if (!empty($files))
        {
            $arr = explode(',', $files);
            foreach ($arr as $js)
            {
                $js = trim($js);
                if (!empty($js))
                {
                    if ('page.' == substr($js, 0, 5))
                    {
                        $html .= "<script type=\"text/javascript\" src=\"{$http}js/{$js}.js?t=4.1.8\"></script>\r\n";
                    } else {
                        $html .= "<script type=\"text/javascript\" src=\"{$http}js/jquery.{$js}.min.js?t=4.1.8\"></script>\r\n";
                    }
                }
            }
        }
        return $html;
    }
    public static function time_tran($datetime)
    {
        return time_tran($datetime);
    }
    public static function pageProductNext($total, $page, $rows, $url, $arg = 'page',$p_title='')
    {
        if ($total <= $rows) {
            return '<a href="javascript:;" class="prev" style="background-color: #ccc"><i></i></a><a href="javascript:;" class="next" style="background-color: #ccc"><i></i></a>';
        }

        if($p_title){
            $_n = '-n';

            $pages  = ceil($total/$rows);
            $from   = 1;
            $to     = $pages;
            $num    = 5;
            $nav    = '';
            if ($page > 1)
            {
//            $nav .= '<li><a href="' . $url .'-n'. ($page-1) . '"><上一页</a></li>';
                $nav .= '<a href="' . $url .$_n. ($page-1) . '" class="prev"><i></i></a>';
            }else{
                $nav .= '<a href="javascript:;" class="prev" style="background-color: #ccc"><i></i></a>';
            }

            if ($pages > $num)
            {
                $mid  = floor($num / 2);
                $from = $page - $mid;
                if (1 > $from)
                {
                    $from = 1;
                }
                $to   = $page + $mid;
                if ($to > $pages)
                {
                    $to = $pages;
                    $from = $pages - $num + 1;
                    if (1 > $from)
                    {
                        $from = 1;
                    }
                }
                elseif ($num > ($to - $from))
                {
                    $to = $from + $num - 1;
                    if ($to > $pages)
                    {
                        $to = $pages;
                    }
                }
            }
            if ($page < $pages)
            {
//            $nav .= '<li><a href="' . $url .'-n'. ($page+1) . '">下一页></a></li>';
                $nav .= '<a href="' . $url .$_n. ($page+1) . '" class="next"><i></i></a>';
            }else{
                $nav .= '<a href="javascript:;" class="next" style="background-color: #ccc"><i></i></a>';
            }
            /*$nav .= '<li class="page_num">' . $page . '/' . $pages . '页</li></ul>';*/
            $nav .= '';
        }else{
            $_n = $url!=''?'-n':'n';
            $_n1 = $url!=''?'-n1':'n1';

            $pages  = ceil($total/$rows);
            $from   = 1;
            $to     = $pages;
            $num    = 5;
            $nav    = '';

            if ($page > 1)
            {
//            $nav .= '<li><a href="' . $url .'-n'. ($page-1) . '"><上一页</a></li>';
                $nav .= '<a href="' . $url .$_n. ($page-1) . '" class="prev"><i></i></a>';
            }else{
                $nav .= '<a href="javascript:;" class="prev" style="background-color: #ccc"><i></i></a>';
            }

            if ($pages > $num)
            {
                $mid  = floor($num / 2);
                $from = $page - $mid;
                if (1 > $from)
                {
                    $from = 1;
                }
                $to   = $page + $mid;
                if ($to > $pages)
                {
                    $to = $pages;
                    $from = $pages - $num + 1;
                    if (1 > $from)
                    {
                        $from = 1;
                    }
                }
                elseif ($num > ($to - $from))
                {
                    $to = $from + $num - 1;
                    if ($to > $pages)
                    {
                        $to = $pages;
                    }
                }
            }
            if ($page < $pages)
            {
//            $nav .= '<li><a href="' . $url .'-n'. ($page+1) . '">下一页></a></li>';
                $nav .= '<a href="' . $url .$_n. ($page+1) . '" class="next"><i></i></a>';
            }else{
                $nav .= '<a href="javascript:;" class="next" style="background-color: #ccc"><i></i></a>';
            }
            /*$nav .= '<li class="page_num">' . $page . '/' . $pages . '页</li></ul>';*/
            $nav .= '';
        }

        return $nav;
    }
    public static function pageProductNav($total, $page, $rows, $url, $arg = 'page',$p_title='')
    {
        if($p_title){
            if ($total <= $rows) { return ''; }
            $pages  = ceil($total/$rows);
            $from   = 1;
            $to     = $pages;
            $num    = 5;
            $nav    = '<ul>';

            if ($page > 1)
            {
                $nav .= '<li><a href="' . $url .'-n1'.'">首页</a></li>';
                $nav .= '<li><a href="' . $url .'-n'. ($page-1) . '"><上一页</a></li>';
            }

            if ($pages > $num)
            {
                $mid  = floor($num / 2);
                $from = $page - $mid;
                if (1 > $from)
                {
                    $from = 1;
                }
                $to   = $page + $mid;
                if ($to > $pages)
                {
                    $to = $pages;
                    $from = $pages - $num + 1;
                    if (1 > $from)
                    {
                        $from = 1;
                    }
                }
                elseif ($num > ($to - $from))
                {
                    $to = $from + $num - 1;
                    if ($to > $pages)
                    {
                        $to = $pages;
                    }
                }
            }
            for ($i = $from; $i <= $to; $i++)
            {
                if ($page == $i)
                {
                    $nav .= '<li class="active"><a href="' . $url .'-n'. $i . '" >' . $i . '</a></li>';
                }
                else
                {
                    $nav .= '<li><a href="' . $url.'-n' . $i . '">' . $i . '</a></li>';
                }
            }
            if ($page < $pages)
            {
                $nav .= '<li><a href="' . $url .'-n'. ($page+1) . '">下一页></a></li>';
                $nav .= '<li><a href="' . $url .'-n'. $pages . '">尾页</a></li>';
            }
            /*$nav .= '<li class="page_num">' . $page . '/' . $pages . '页</li></ul>';*/
            $nav .= '</ul>';
        }else{
            $_n = $url!=''?'-n':'n';
            $_n1 = $url!=''?'-n1':'n1';

            if ($total <= $rows) { return ''; }
            $pages  = ceil($total/$rows);
            $from   = 1;
            $to     = $pages;
            $num    = 5;
            $nav    = '<ul>';

            if ($page > 1)
            {
                $nav .= '<li><a href="' . $url . $_n1.'">首页</a></li>';
                $nav .= '<li><a href="' . $url .$_n. ($page-1) . '"><上一页</a></li>';
            }

            if ($pages > $num)
            {
                $mid  = floor($num / 2);
                $from = $page - $mid;
                if (1 > $from)
                {
                    $from = 1;
                }
                $to   = $page + $mid;
                if ($to > $pages)
                {
                    $to = $pages;
                    $from = $pages - $num + 1;
                    if (1 > $from)
                    {
                        $from = 1;
                    }
                }
                elseif ($num > ($to - $from))
                {
                    $to = $from + $num - 1;
                    if ($to > $pages)
                    {
                        $to = $pages;
                    }
                }
            }
            for ($i = $from; $i <= $to; $i++)
            {
                if ($page == $i)
                {
                    $nav .= '<li class="active"><a href="' . $url .$_n. $i . '" >' . $i . '</a></li>';
                }
                else
                {
                    $nav .= '<li><a href="' . $url.$_n . $i . '">' . $i . '</a></li>';
                }
            }
            if ($page < $pages)
            {
                $nav .= '<li><a href="' . $url .$_n. ($page+1) . '">下一页></a></li>';
                $nav .= '<li><a href="' . $url .$_n. $pages . '">尾页</a></li>';
            }
            /*$nav .= '<li class="page_num">' . $page . '/' . $pages . '页</li></ul>';*/
            $nav .= '</ul>';
        }

        return $nav;
    }
    public static function pageNav($total, $page, $rows, $url, $arg = 'page',$p_title='') //return page navigator
    {
        if ($total <= $rows) { return ''; }
        /*修改url*/
        /*if ('/' != substr($url, -1)) { $url .= '/' . $arg . '/'; }
        else { $url .= $arg . '/'; }*/

        $pages  = ceil($total/$rows);
        $from   = 1;
        $to     = $pages;
        $num    = 5;
        $nav    = '<ul>';

        if ($page > 1)
        {
            $nav .= '<li><a href="' . $url . '-line-1">首页</a></li>';
            $nav .= '<li><a href="' . $url .'-line-'. ($page-1) . '"><上一页</a></li>';
        }

        if ($pages > $num)
        {
            $mid  = floor($num / 2);
            $from = $page - $mid;
            if (1 > $from)
            {
                $from = 1;
            }
            $to   = $page + $mid;
            if ($to > $pages)
            {
                $to = $pages;
                $from = $pages - $num + 1;
                if (1 > $from)
                {
                    $from = 1;
                }
            }
            elseif ($num > ($to - $from))
            {
                $to = $from + $num - 1;
                if ($to > $pages)
                {
                    $to = $pages;
                }
            }
        }
        for ($i = $from; $i <= $to; $i++)
        {
            if ($page == $i)
            {
                $nav .= '<li class="active"><a href="' . $url .'-line-'. $i . '" >' . $i . '</a></li>';
            }
            else
            {
                $nav .= '<li><a href="' . $url.'-line-' . $i . '">' . $i . '</a></li>';
            }
        }
        if ($page < $pages)
        {
            $nav .= '<li><a href="' . $url .'-line-'. ($page+1) . '">下一页></a></li>';
            $nav .= '<li><a href="' . $url .'-line-'. $pages . '">尾页</a></li>';
        }
        /*$nav .= '<li class="page_num">' . $page . '/' . $pages . '页</li></ul>';*/
        $nav .= '</ul>';

        return $nav;
    }
    public static function pageNavAbout($total, $page, $rows, $url, $arg = 'page') //return page navigator
    {
        if ($total <= $rows) { return ''; }
        /*修改url*/
        /*if ('/' != substr($url, -1)) { $url .= '/' . $arg . '/'; }
        else { $url .= $arg . '/'; }*/

        $pages  = ceil($total/$rows);
        $from   = 1;
        $to     = $pages;
        $num    = 5;
        $nav    = '<ul>';

        if ($page > 1)
        {
            $nav .= '<li><a href="' . $url . '/page/1">首页</a></li>';
            $nav .= '<li><a href="' . $url .'/page/'. ($page-1) . '"><上一页</a></li>';
        }

        if ($pages > $num)
        {
            $mid  = floor($num / 2);
            $from = $page - $mid;
            if (1 > $from)
            {
                $from = 1;
            }
            $to   = $page + $mid;
            if ($to > $pages)
            {
                $to = $pages;
                $from = $pages - $num + 1;
                if (1 > $from)
                {
                    $from = 1;
                }
            }
            elseif ($num > ($to - $from))
            {
                $to = $from + $num - 1;
                if ($to > $pages)
                {
                    $to = $pages;
                }
            }
        }
        for ($i = $from; $i <= $to; $i++)
        {
            if ($page == $i)
            {
                $nav .= '<li class="active"><a href="' . $url .'/page/'. $i . '" >' . $i . '</a></li>';
            }
            else
            {
                $nav .= '<li><a href="' . $url.'/page/' . $i . '">' . $i . '</a></li>';
            }
        }
        if ($page < $pages)
        {
            $nav .= '<li><a href="' . $url .'/page/'. ($page+1) . '">下一页></a></li>';
            $nav .= '<li><a href="' . $url .'/page/'. $pages . '">尾页</a></li>';
        }
        /*$nav .= '<li class="page_num">' . $page . '/' . $pages . '页</li></ul>';*/
        $nav .= '</ul>';

        return $nav;
    }
    public static function pageNavWD($total, $page, $rows, $url, $status = 0) //return page navigator
    {
        if ($total <= $rows) { return ''; }
        /*修改url*/
        /*if ('/' != substr($url, -1)) { $url .= '/' . $arg . '/'; }
        else { $url .= $arg . '/'; }*/
        $pages  = ceil($total/$rows);
        $from   = 1;
        $to     = $pages;
        $num    = 5;
        $nav    = '<ul>';
        if ($page > 1)
        {
            $nav .= '<li><a href="' . $url . '?page=1&status="'.$status.'>首页</a></li>';
            $nav .= '<li><a href="' . $url .'?page='. ($page-1) . '&status="'.$status.'><上一页</a></li>';
        }

        if ($pages > $num)
        {
            $mid  = floor($num / 2);
            $from = $page - $mid;
            if (1 > $from)
            {
                $from = 1;
            }
            $to   = $page + $mid;
            if ($to > $pages)
            {
                $to = $pages;
                $from = $pages - $num + 1;
                if (1 > $from)
                {
                    $from = 1;
                }
            }
            elseif ($num > ($to - $from))
            {
                $to = $from + $num - 1;
                if ($to > $pages)
                {
                    $to = $pages;
                }
            }
        }
        for ($i = $from; $i <= $to; $i++)
        {
            if ($page == $i)
            {
                $nav .= '<li class="active"><a href="' . $url . '?page='.$i.'&status='.$status.'" >' . $i . '</a></li>';
            }
            else
            {
                $nav .= '<li><a href="' . $url. '?page='.$i.'&status='.$status.'">' . $i . '</a></li>';
            }
        }
        if ($page < $pages)
        {
            $nav .= '<li><a href="' . $url .'?page='. ($page+1) . '&status='.$status.'">下一页></a></li>';
            $nav .= '<li><a href="' . $url .'?page='. $pages . '&status='.$status.'">尾页</a></li>';
        }
        /*$nav .= '<li class="page_num">' . $page . '/' . $pages . '页</li></ul>';*/
        $nav .= '</ul>';

        return $nav;
    }

    /**
     *  贷款机构分页
     * @param int    $total 总数
     * @param int    $page  当前页
     * @param array  $rows  每页显示记录数
     * @param string $url   分页的链接
     * @param string $key   t 固定值
     * @param string $value 机构类型 0不限 1银行 2P2P平台 3小贷公司 4典当行
     *
     * @return string  分页html
     */
    public static function pageNavOrg($total, $page, $rows, $url,$key,$value)
    {
        if ($total <= $rows) { return ''; }
        $pages  = ceil($total/$rows);  //计算总页数
        $from   = 1;
        $to     = $pages;
        $num    = 5;
        $nav    = '<ul>';
        if ($page > 1)
        {
            $nav .= '<li><a href="' . $url . 'p=1&'.$key.'='.$value.'">首页</a></li>';
            $nav .= '<li><a href="' . $url .'p='. ($page-1) . '&'.$key.'='.$value.'"><上一页</a></li>';
        }

        if ($pages > $num)
        {
            $mid  = floor($num / 2);
            $from = $page - $mid;
            if (1 > $from)
            {
                $from = 1;
            }
            $to   = $page + $mid;
            if ($to > $pages)
            {
                $to = $pages;
                $from = $pages - $num + 1;
                if (1 > $from)
                {
                    $from = 1;
                }
            }
            elseif ($num > ($to - $from))
            {
                $to = $from + $num - 1;
                if ($to > $pages)
                {
                    $to = $pages;
                }
            }
        }
        for ($i = $from; $i <= $to; $i++)
        {
            if ($page == $i)
            {
                $nav .= '<li class="active"><a href="' . $url .'p='. $i . '&'.$key.'='.$value.'" >' . $i . '</a></li>';
            }
            else
            {
                $nav .= '<li><a href="' . $url.'p=' . $i . '&'.$key.'='.$value.'">' . $i . '</a></li>';
            }
        }
        if ($page < $pages)
        {
            $nav .= '<li><a href="' . $url .'p='. ($page+1) . '&'.$key.'='.$value.'">下一页></a></li>';
            $nav .= '<li><a href="' . $url .'p='. $pages . '&'.$key.'='.$value.'">尾页</a></li>';
        }
        /*$nav .= '<li class="page_num">' . $page . '/' . $pages . '页</li></ul>';*/
        $nav .= '</ul>';

        return $nav;
    }
    public static function pageNavWDFaq($total, $page, $rows, $url, $key,$value) //return page navigator
    {
        if ($total <= $rows) { return ''; }
        $pages  = ceil($total/$rows);
        $from   = 1;
        $to     = $pages;
        $num    = 5;
        $nav    = '<ul>';
        if ($page > 1)
        {
            $nav .= '<li><a href="' . $url . '-1.html?'.$key.'='.$value.'">首页</a></li>';
            $nav .= '<li><a href="' . $url .'-'. ($page-1) . '.html?'.$key.'='.$value.'"><上一页</a></li>';
        }

        if ($pages > $num)
        {
            $mid  = floor($num / 2);
            $from = $page - $mid;
            if (1 > $from)
            {
                $from = 1;
            }
            $to   = $page + $mid;
            if ($to > $pages)
            {
                $to = $pages;
                $from = $pages - $num + 1;
                if (1 > $from)
                {
                    $from = 1;
                }
            }
            elseif ($num > ($to - $from))
            {
                $to = $from + $num - 1;
                if ($to > $pages)
                {
                    $to = $pages;
                }
            }
        }
        for ($i = $from; $i <= $to; $i++)
        {
            if ($page == $i)
            {
                $nav .= '<li class="active"><a href="' . $url .'-'. $i . '.html?'.$key.'='.$value.'" >' . $i . '</a></li>';
            }
            else
            {
                $nav .= '<li><a href="' . $url.'-' . $i . '.html?'.$key.'='.$value.'">' . $i . '</a></li>';
            }
        }
        if ($page < $pages)
        {
            $nav .= '<li><a href="' . $url .'-'. ($page+1) . '.html?'.$key.'='.$value.'">下一页></a></li>';
            $nav .= '<li><a href="' . $url .'-'. $pages . '.html?'.$key.'='.$value.'">尾页</a></li>';
        }
        /*$nav .= '<li class="page_num">' . $page . '/' . $pages . '页</li></ul>';*/
        $nav .= '</ul>';

        return $nav;
    }

    public function page($s_id, $curpage, $previousPage, $startPage, $endPage, $totalPage, $nextPage, $lastPage, $total, $s_ab)
    {
        $htm = '<li><a href="/'.$s_ab.'/1">首页</a></li>';

        if($curpage > 1)
        {
            $htm .= '<li><a href="/'.$s_ab.'/' . $previousPage . '">上一页</a></li>';
        }

        for($i = $startPage; $i <= $endPage; $i++)
        {
            if( $i != $curpage )
            {
                $htm .= '<li><a href="/'.$s_ab.'/' . $i . '">'. $i . '</a></li>';
            }else{
                $htm .= '<li class="page_hover">'. $i . '</li>';
            }

        }

        if($curpage < $totalPage)
        {
            $htm .= '<li><a href="/'.$s_ab.'/' . $nextPage . '">下一页</a></li>';
        }

        $htm .= '<li><a href="/'.$s_ab.'/'. $lastPage .'">末页</a></li>';

        $htm .= '<li><select name="page" onchange="pageJump(this.value)">';
        for($i=1; $i<=$totalPage; $i++)
        {
            $htm .= '<option value="'.$i.'"';
            if( $i == $curpage)
            {
                $htm .= ' selected=selected';
            }
            $htm .= '>'.$i.'</option>';
        }
        $htm .= '</select></li>';

        $htm .= '<li><span class="pageinfo">共 <strong>' . $totalPage . '</strong>页<strong>' . $total . '</strong>条</span></li>';

        return $htm;
    }

    public function sub_string($string,$length,$end_str='…',$is_strip=0)
    {
        if($is_strip)
        {
            $string = strip_tags($string);
        }
        if(mb_strlen($string,"UTF-8")<=$length)
        {
            return $string;
        }else{
            return mb_substr($string,0,$length,'UTF-8').$end_str;
        }
    }
    /**
     * $num 数字字符串
     * $s   数字开头显示的个数
     * $e   数字结尾显示的个数
     */
    public function hidecenternum($num,$s,$e)
    {
        if(!is_numeric($num)){
            return $num;
        }
        $l =  mb_strlen($num,'UTF-8');
        $str1 = substr($num, 0,$s);
        $str2 = substr($num, -$e);
        if($l<($s+$e)){
            return '****';
        }
        $c = '';
        for($i=0;$i<$l-$s-$e;$i++){
            $c .= "*";
        }
        return $str1.$c.$str2;
    }
    public function inclUrl($url="")
    {
        return file_get_contents("http://".$_SERVER['HTTP_HOST'].$url);
    }
    public function formRegion($name = 'region' ,$regions = array(), $default_item = '请选择',$paramStr='')
    {
        $htm = '<select id="'.$name.'1" name="'.$name.'1" onchange="getSubRegion(\'/Region/getSubRegionList/default_item/'.urlencode($default_item."市").'/id/\'+this.value+\'/\',\''.$name.'2\',\''.$name.'3\')" class="refresh_region btn_data"  '.$paramStr.' >';
        $htm.='<option value="0">'.$default_item.'省</option>';
        if(count($regions['provinceList']))
        {
            foreach($regions['provinceList'] as $v)
            {
                if(isset($regions['default']['province_id']) && $v['sr_id']==$regions['default']['province_id'])
                {
                    $htm.='<option value="'.$v['sr_id'].'" selected="selected" >'.$v['sr_name'].'</option>';
                }
                else
                {
                    $htm.='<option value="'.$v['sr_id'].'">'.$v['sr_name'].'</option>';
                }
            }
        }

        $htm .= '</select>';

        $htm .= '<select id="'.$name.'2" name="'.$name.'2" onchange="getSubRegion(\'/Region/getSubRegionList/default_item/'.urlencode($default_item."县").'/id/\'+this.value+\'/\',\''.$name.'3\',\''.$name.'3\')" class="refresh_region btn_data" '.$paramStr.'  >';
        $htm.='<option value="0">'.$default_item.'市</option>';
        if(isset($regions['cityList']) && count($regions['cityList']))
        {
            foreach($regions['cityList'] as $v)
            {
                if($v['sr_id']==$regions['default']['city_id'])
                {
                    $htm.='<option value="'.$v['sr_id'].'" selected="selected" >'.$v['sr_name'].'</option>';
                }
                else
                {
                    $htm.='<option value="'.$v['sr_id'].'">'.$v['sr_name'].'</option>';
                }
            }
        }
        $htm .= '</select>';


        $htm .= '<select id="'.$name.'3" name="'.$name.'3" class="must btn_data" '.$paramStr.' >';
        $htm.='<option value="0">'.$default_item.'县</option>';
        if(isset($regions['districtList']) && count($regions['districtList']))
        {
            foreach($regions['districtList'] as $v)
            {
                if($v['sr_id']==$regions['default']['district_id'])
                {
                    $htm.='<option value="'.$v['sr_id'].'" selected="selected" >'.$v['sr_name'].'</option>';
                }
                else
                {
                    $htm.='<option value="'.$v['sr_id'].'">'.$v['sr_name'].'</option>';
                }
            }
        }

        $htm .= '</select>';
        return $htm.'<script type="text/javascript">
							function getSubRegion(url,name,def)
							{
								$.get(url, function(data){
								  $("#"+def).html(\'<option value="0">'.$default_item.'县</option>\');
								  $("#"+name).html(data);
								});
							}
							</script> ';

    }

    public function formRegions($name = 'region' ,$regions = array(), $default_item = '',$paramStr='')
    {
        $html = '<ul>'.
            '<input name="province" type="hidden" value="'.$default_item.'省" id="countryname"/>'.
            ' <i class="icon-37"></i><span id="countryspan">'.$default_item.'省</span>'.
            '<i class="icon-41 icon-btn"></i>'.
            '<div class="list" data="countryname">';
        if(count($regions['provinceList']))
        {
            foreach($regions['provinceList'] as $v)
            {
                if(isset($regions['default']['province_id']) && $v['sr_id']==$regions['default']['province_id'])
                {
                    $html.='<li onclick="getSubRegion(this,\'/Region/getSubRegionList/default_item/'.urlencode($default_item."市").'/id/'.$v["sr_id"].'/m/1\',\''.$name.'1\',\'0\')">'.$v['sr_name'].'</li>';
                }
                else
                {
                    $html.='<li onclick="getSubRegion(this,\'/Region/getSubRegionList/default_item/'.urlencode($default_item."市").'/id/'.$v["sr_id"].'/m/1\',\''.$name.'1\',\''.$v["sr_id"].'\')">'.$v['sr_name'].'</li>';
                }
            }
        }
        $html .= '</div>'.
            '</ul>';

        $html.= '<ul>'.
            '<input name="city" type="hidden" value="'.$default_item.'市" id="cityname" />'.
            ' <span id="cityspan">'.$default_item.'市</span>'.
            '<i class="icon-41 icon-btn"></i>'.
            '<div class="list" data="cityname" id="region1">';
        if(isset($regions['cityList']) && count($regions['cityList']))
        {
            foreach($regions['cityList'] as $v)
            {
                if($v['sr_id']==$regions['default']['city_id'])
                {
                    $html.='<li onclick="getSubRegion(this,\'/Region/getSubRegionList/default_item/'.urlencode($default_item."市").'/id/'.$v["sr_id"].'/m/1\',\''.$name.'1\',\'0\')">'.$v['sr_name'].'</li>';
                }
                else
                {
                    $html.='<li onclick="getSubRegion(this,\'/Region/getSubRegionList/default_item/'.urlencode($default_item."市").'/id/'.$v["sr_id"].'/m/1\',\''.$name.'1\',\'0\')">'.$v['sr_name'].'</li>';
                }
            }
        }
        $html .= '</div>'.
            '</ul>';

        $html.= '<ul>'.
            '<input name="county" type="hidden" value="'.$default_item.'县" id="areaname"/>'.
            ' <span  id="areaspan">'.$default_item.'县</span>'.
            '<i class="icon-41 icon-btn"></i>'.
            '<div class="list" data="areaname" id="region2">';
        if(isset($regions['districtList']) && count($regions['districtList']))
        {
            foreach($regions['districtList'] as $v)
            {
                if($v['sr_id']==$regions['default']['district_id']) {
                    $html .= '<li><a href="#">' . $v['sr_name'] . '</a></li>';
                }
                else
                {
                    $html.='<li><a href="#">'.$v['sr_name'].'</a></li>';
                }
            }
        }
        $html .= '</div>'.
            '</ul>';
        return $html.'<script type="text/javascript">
							function getSubRegion(that,url,name,def)
							{
								$.get(url, function(data){
//								  $("#"+def).html(\'<option value="0">'.$default_item.'县</option>\');
								  $("#"+name).html(data);
								    if(name.indexOf("1")>0){
								    console.log(name.indexOf("1"));
								     $(that).parent().siblings(\'span\').html(val);
								    $("#cityname").html(\'0\');
								    $("#areaname").html(\'0\');
								    $("#cityspan").html(\''.$default_item.'市\');
								    $("#areaspan").html(\''.$default_item.'县\');
                                    }
                                     if(name.indexOf("2")>0){
								     $(that).parent().siblings(\'span\').html(val);
								    $("#areaname").html(\'0\');
								    $("#areaspan").html(\''.$default_item.'县\');
                                    }
								});
								 var name1=$(that).parent().attr(\'data\');
                                    var val=$(that).html();
                                   $(that).parent().siblings(\'span\').html(val);
                                    $(that).parent().siblings(\'#\'.name1).val(def);
								}
							</script> ';

    }
    public function formRegionsCity($name = 'region' ,$regions = array(), $default_item = '请选择',$paramStr='')
    {
        $html = '<ul>'.
            '<input name="countryname" type="hidden" value="'.$default_item.'省" id="countryname"/>'.
            ' <span>'.$default_item.'省</span>'.
            '<i class="icon-41 icon-btn"></i>'.
            '<div class="list" data="countryname">';
        if(count($regions['provinceList']))
        {
            foreach($regions['provinceList'] as $v)
            {
                if(isset($regions['default']['province_id']) && $v['sr_id']==$regions['default']['province_id'])
                {
                    $html.='<li onclick="getSubRegion(this,\'/Region/getSubRegionCityList/default_item/'.urlencode($default_item."市").'/id/'.$v["sr_id"].'/m/1\',\''.$name.'1\',\'0\')">'.$v['sr_name'].'</li>';
                }
                else
                {
                    $html.='<li onclick="getSubRegion(this,\'/Region/getSubRegionCityList/default_item/'.urlencode($default_item."市").'/id/'.$v["sr_id"].'/m/1\',\''.$name.'1\',\''.$v["subsite_domain"].'\')">'.$v['sr_name'].'</li>';
                }
            }
        }
        $html .= '</div>'.
            '</ul>';

        $html.= '<ul>'.
            '<input name="cityname" type="hidden" value="'.$default_item.'市" id="cityname" />'.
            ' <span>'.$default_item.'市</span>'.
            '<i class="icon-41 icon-btn"></i>'.
            '<div class="list" data="cityname" id="region1">';
        if(isset($regions['cityList']) && count($regions['cityList']))
        {
            foreach($regions['cityList'] as $v)
            {
                if($v['sr_id']==$regions['default']['city_id'])
                {
                    $html.='<li onclick="getSubRegion(this,\'/Region/getSubRegionCityList/default_item/'.urlencode($default_item."市").'/id/'.$v["sr_id"].'/m/1\',\''.$name.'1\',\'0\')">'.$v['sr_name'].'</li>';
                }
                else
                {
                    $html.='<li onclick="getSubRegion(this,\'/Region/getSubRegionCityList/default_item/'.urlencode($default_item."市").'/id/'.$v["sr_id"].'/m/1\',\''.$name.'1\',\'0\')">'.$v['sr_name'].'</li>';
                }
            }
        }
        $html .= '</div>'.
            '</ul>';
        return $html.'<script type="text/javascript">
                            function getSubRegion(that,url,name,def)
                            {
                                $.get(url, function(data){
                                  $("#"+def).html(\'<option value="0">'.$default_item.'县</option>\');
                                  $("#"+name).html(data);
                                });
                                 var name1=$(that).parent().attr(\'data\');
                                    var val=$(that).html();
                                   $(that).parent().siblings(\'span\').html(val);
                                    $(that).parent().siblings(\'#\'.name1).val(def);
                                }
                            </script> ';

    }


    public function formRegion64($name = 'region' ,$regions = array(), $default_item = '请选择',$paramStr='', $clas_name ='')
    {
        $htm = '<select id="'.$name.'1" name="'.$name.'1" onchange="getSubRegion(\'/Region/getSubRegionList64/default_item/'.urlencode($default_item."市").'/id/\'+this.value+\'/\',\''.$name.'2\',\''.$name.'3\')" class="refresh_region btn_data '.$clas_name.'"  '.$paramStr.' >';
        $htm.='<option value="0">'.$default_item.'省</option>';
        if(count($regions['provinceList']))
        {
            foreach($regions['provinceList'] as $v)
            {
                if(isset($regions['default']['province_id']) && $v['sr_id']==$regions['default']['province_id'])
                {
                    $htm.='<option value="'.$v['sr_id'].'" selected="selected" >'.$v['sr_name'].'</option>';
                }
                else
                {
                    $htm.='<option value="'.$v['sr_id'].'">'.$v['sr_name'].'</option>';
                }
            }
        }

        $htm .= '</select>';

        $htm .= '<select id="'.$name.'2" name="'.$name.'2" onchange="getSubRegion(\'/Region/getSubRegionList64/default_item/'.urlencode($default_item."县").'/id/\'+this.value+\'/\',\''.$name.'3\',\''.$name.'3\')" class="refresh_region btn_data '.$clas_name.'" '.$paramStr.'  >';
        $htm.='<option value="0">'.$default_item.'市</option>';
        if(isset($regions['cityList']) && count($regions['cityList']))
        {
            foreach($regions['cityList'] as $v)
            {
                if($v['sr_id']==$regions['default']['city_id'])
                {
                    $htm.='<option value="'.$v['sr_id'].'" selected="selected" >'.$v['sr_name'].'</option>';
                }
                else
                {
                    $htm.='<option value="'.$v['sr_id'].'">'.$v['sr_name'].'</option>';
                }
            }
        }
        $htm .= '</select>';


        $htm .= '<select id="'.$name.'3" name="'.$name.'3" class="must btn_data '.$clas_name.'" '.$paramStr.' >';
        $htm.='<option value="0">'.$default_item.'县</option>';
        if(isset($regions['districtList']) && count($regions['districtList']))
        {
            foreach($regions['districtList'] as $v)
            {
                if($v['sr_id']==$regions['default']['district_id'])
                {
                    $htm.='<option value="'.$v['sr_id'].'" selected="selected" >'.$v['sr_name'].'</option>';
                }
                else
                {
                    $htm.='<option value="'.$v['sr_id'].'">'.$v['sr_name'].'</option>';
                }
            }
        }

        $htm .= '</select>';
        return $htm.'<script type="text/javascript">
                            function getSubRegion(url,name,def)
                            {
                                var b64 = new Base64();
                                var ch = Array;
                                 ch = url.split("/default_item/");
                                 url = ch[0]+"/default_item/"+b64.encode(ch[1]);
                                 //alert(url);
                                $.get(url, function(data){
                                  $("#"+def).html(\'<option value="0">'.$default_item.'县</option>\');
                                  $("#"+name).html(data);
                                });
                            }
                            </script> ';

    }
    public function formRegionCity($name = 'region' ,$regions = array(), $default_item = '请选择',$paramStr='')
    {
        $htm = '<select id="'.$name.'1" name="'.$name.'1" onchange="getSubRegion(\'/Region/getSubRegionCityList/default_item/'.urlencode($default_item."市").'/id/\'+this.value+\'/\',\''.$name.'2\',\''.$name.'3\')" class="refresh_region btn_data"  '.$paramStr.' >';
        $htm.='<option value="0">'.$default_item.'省</option>';
        if(count($regions['provinceList']))
        {
            foreach($regions['provinceList'] as $v)
            {
                if(isset($regions['default']['province_id']) && $v['sr_id']==$regions['default']['province_id'])
                {
                    $htm.='<option value="'.$v['sr_id'].'" selected="selected" >'.$v['sr_name'].'</option>';
                }
                else
                {
                    $htm.='<option value="'.$v['sr_id'].'">'.$v['sr_name'].'</option>';
                }
            }
        }

        $htm .= '</select>';

        $htm .= '<select id="'.$name.'2" name="'.$name.'2" onchange="getSubRegion(\'/Region/getSubRegionCityList/default_item/'.urlencode($default_item."县").'/id/\'+this.value+\'/\',\''.$name.'3\',\''.$name.'3\')" class="refresh_region btn_data" '.$paramStr.'  >';
        $htm.='<option value="0">'.$default_item.'市</option>';
        if(isset($regions['cityList']) && count($regions['cityList']))
        {
            foreach($regions['cityList'] as $v)
            {
                if($v['sr_id']==$regions['default']['city_id'])
                {
                    $htm.='<option value="'.$v['sr_id'].'" selected="selected" >'.$v['sr_name'].'</option>';
                }
                else
                {
                    $htm.='<option value="'.$v['sr_id'].'">'.$v['sr_name'].'</option>';
                }
            }
        }
        $htm .= '</select>';


        $htm .= '<select id="'.$name.'3" name="'.$name.'3" class="must btn_data" '.$paramStr.' >';
        $htm.='<option value="0">'.$default_item.'县</option>';
        if(isset($regions['districtList']) && count($regions['districtList']))
        {
            foreach($regions['districtList'] as $v)
            {
                if($v['sr_id']==$regions['default']['district_id'])
                {
                    $htm.='<option value="'.$v['sr_id'].'" selected="selected" >'.$v['sr_name'].'</option>';
                }
                else
                {
                    $htm.='<option value="'.$v['sr_id'].'">'.$v['sr_name'].'</option>';
                }
            }
        }

        $htm .= '</select>';
        return $htm.'<script type="text/javascript">
                            function getSubRegion(url,name,def)
                            {
                                $.get(url, function(data){
                                  $("#"+def).html(\'<option value="0">'.$default_item.'县</option>\');
                                  $("#"+name).html(data);
                                });
                            }
                            </script> ';

    }


    public function formText($name, $value = '', $paramStr = '')
    {
        $htm = "<input type='text' name='{$name}' value='{$value}' {$paramStr} />";
        return $htm;
    }

    public function formSelect($name, $options = array(), $value = null , $combox = false, $paramStr='')
    {
        $htm = '<select' . ($combox ? ' class="combox"' : '') . ' name="' . $name . '" ' . $paramStr . '>';
        if (null === $value)
        {
            $value = key($options);
        }
        foreach ($options as $k => $v)
        {
            if ($k == $value)
            {
                $htm .= '<option value="' . $k . '" selected="selected">' . $v . '</option>';
            }
            else
            {
                $htm .= '<option value="' . $k . '">' . $v . '</option>';
            }
        }
        $htm .= '</select>';
        return $htm;
    }

    public function formCheckbox($name, $array = array(), $value, $enclose='', $paramStr='')
    {
        $value = explode(',',$value);
        $htm   = '';
        foreach($array as $k => $v)
        {
            if (in_array($k , $value))
            {
                $htm .= ((empty($enclose))?"":"<$enclose>")."<input id='{$name}{$k}' type='checkbox' checked='checked'  value='{$k}' name='{$name}[]' {$paramStr}><label {$paramStr} for='{$name}{$k}'>{$v}</label>".((empty($enclose))?"":"<$enclose>");
            }
            else
            {
                $htm .= ((empty($enclose))?"":"<$enclose>")."<input id='{$name}{$k}' type='checkbox' value='{$k}' name='{$name}[]' {$paramStr}><label {$paramStr} for='{$name}{$k}'>{$v}</label>".((empty($enclose))?"":"<$enclose>");
            }
        }
        return $htm;
    }

    public function formRadio($name, $array = array(), $value, $enclose='', $paramStr='')
    {
        $htm   = '';
        if($value=='')$value='-100';
        foreach($array as $k=>$v)
        {
            if($k==$value)
                $htm .= ((empty($enclose))?"":"<$enclose>")."<input type='radio' value='{$k}' checked='checked' id='{$name}{$k}' name='{$name}' {$paramStr}><label {$paramStr} for='{$name}{$k}'>{$v}</label>".((empty($enclose))?"":"<$enclose>")."&nbsp;&nbsp;";
            else
                $htm .= ((empty($enclose))?"":"<$enclose>")."<input type='radio' value='{$k}'  name='{$name}' id='{$name}{$k}' {$paramStr}><label {$paramStr} for='{$name}{$k}'>{$v}</label>".((empty($enclose))?"":"<$enclose>")."&nbsp;&nbsp;";
        }
        return $htm;
    }

    public function showYesNo($value = false)
    {
        if (empty($value))
            return '--';
        else
            return '是';
    }

    public function showChecked($value = false)
    {
        if (empty($value))
            return '<span style="color:red;font-weight:bold;line-height:21px;">×</span>';
        else
            return '<span style="color:blue;font-weight:bold;line-height:21px;">√</span>';
    }

    /**
     * 友好日期显示
     * @param $ftime 需要显示的时间（unix时间戳）
     * @param $type  超过一天需要格式化的时间格式
     */
    public static function friendlyDate($ftime, $type = 'Y-m-d H:i:s')
    {

        $time = time() - $ftime;

        if ($time <= 24 * 3600)
        {
            if ($time > 3600) {
                $timestring = intval($time / 3600) . '小时前';
            } elseif ($time > 60) {
                $timestring = intval($time / 60) . '分钟前';
            } elseif ($time > 0) {
                $timestring = $time . '秒前';
            } else {
                $timestring = '刚刚';
            }
        }else{
            $timestring = date($type, $ftime);
        }

        return $timestring;
    }
}

// 视图引擎实现类
class View implements Yaf\View_Interface
{
    /**
     * template object
     * @var template
     */
    public $_T;

    /**
     * template path
     * @var string
     */
    protected $_P;

    /**
     * Constructor
     *
     * @param   string      $tmplPath
     * @param   array       $extraParams
     * @return  void
     */
    public function __construct($tmplPath = null, $extraParams = array())
    {
        $this->_T = new dwzTemplate();
        $this->_P = '';

        if (null !== $tmplPath)
        {
            $this->setScriptPath($tmplPath);
        }

        if (!empty($extraParams))
        {
            $this->assign($extraParams);
        }
    }

    /**
     * Assign variables to the template
     *
     * Allows setting a specific key to the specified value, OR passing
     * an array of key => value pairs to set en masse.
     *
     * @param   string|array    $spec   The assignment strategy to use
     * @param   mixed           $value  (Optional)
     * @return  void
     */
    public function assign($spec, $value = null)
    {
        if (is_array($spec))
        {
            $this->_T->set($spec);
        }
        else if (null !== $value)
        {
            $this->_T->set(array($spec => $value));
        }
    }

    /**
     * Processes a template and returns the output.
     *
     * @param   string          $view_file
     * @param   array           $tpl_vars  (Optional)
     * @return  string
     */
    public function render($view_file, $tpl_vars = null)
    {
        if (file_exists($this->_P . $view_file))
        {
            $body = file_get_contents($this->_P . $view_file);
            $body = str_replace('/VIEW_PATH/', $this->_P, $body);
            $this->_T->load($body);

            if (is_array($tpl_vars))
            {
                $this->_T->set($tpl_vars);
            }

            //$this->_T->parse();
            $this->_T->display();

            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Processes a template and display the output.
     *
     * @param   string          $view_file
     * @param   array           $tpl_vars  (Optional)
     * @return  string
     */
    public function display($view_file, $tpl_vars = null)
    {
        if (file_exists($this->_P . $view_file))
        {
            $body = file_get_contents($this->_P . $view_file);
            $body = str_replace('/VIEW_PATH/', $this->_P, $body);

            $this->_T->load($body);

            if (is_array($tpl_vars))
            {
                $this->_T->set($tpl_vars);
            }

            $this->_T->display();
        }
    }

    /**
     * setting the path of template.
     *
     * @param   string          $view_directory
     * @return  boolean
     */
    public function setScriptPath($view_directory)
    {
        if ('' !== $this->_P)
        {
            return true;
        }
        else if (is_dir($view_directory))
        {
            if ('/' === substr($view_directory, -1))
            {
                $this->_P = $view_directory;
            }
            else
            {
                $this->_P = $view_directory . '/';
            }
            //$this->_T->set(array('view_path' => $this->_P));
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * return the path of template.
     *
     * @param   void
     * @return  string
     */
    public function getScriptPath()
    {
        return $this->_P;
    }
}

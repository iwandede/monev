<?php
/* 
 * Uji Emisi
 */
 function sk_select($tbl='',$fild='',$condition='',$limit='',$page='')
{
    if(!empty($fild)){
        $fild = $fild;
    }else{
        $fild = '*';
    }
    
    if(!empty($page)){
        $page = $page;
    }else{
        $page = 0;
    }
    
    if(!empty($limit)){
        $limit = 'LIMIT '.$page.','.$limit;
    }else{
        $limit = 'LIMIT '.$page.'100';
    }
    #echo 'SELECT '.$fild.' FROM '.$tbl.' '.$condition.' '.$limit;
    $query = mysql_query('SELECT '.$fild.' FROM '.$tbl.' '.$condition.' '.$limit) or die(mysql_error());
    $result = array();
    while ($record = mysql_fetch_array($query)) {
         $result[] = $record;
    }
    return $result;
}

function sk_Insert($tbl = '', $arrayData, $multi = false)
    {
        $fields = "";
        $data = "";
        $tagNotExecute = TAGNOTEXECUTE;
        if (!$multi) {
            while (list($key, $value) = @each($arrayData)) {
                $fields .= $fields == "" ? "`" . $key . "`" : ",`" . $key . "`";
                if (substr($value, 0, 3) != $tagNotExecute) {
                    $data .= $data == "" ? "'" . $value . "'" : ",'" . $value . "'";
                } else {
                    $value = substr($value, 3, strlen($value));
                    $data .= $data == "" ? "" . $value . "" : "," . $value . "";
                }
            }
            if ($fields != "") {
                $fields = " ( " . $fields . " ) ";
            }
            if ($data != "") {
                $data = " ( " . $data . " ) ";
            }
        } else {
            for ($i = 0; $i < sizeof($arrayData); $i++) {
                $tempData = "";
                while (list($key, $value) = each($arrayData[$i])) {
                    if ($i == 0) {
                        $fields .= $fields == "" ? "`" . $key . "`" : ",`" . $key . "`";
                    }
                    if (substr($value, 0, 3) != $tagNotExecute) {
                        $tempData .= $tempData == "" ? "'" . $value . "'" : ",'" . $value . "'";
                    } else {
                        $value = substr($value, 3, strlen($value));
                        $tempData .= $tempData == "" ? "" . $value . "" : "," . $value . "";
                    }
                }
                if ($i == 0) {
                    if ($fields != "") {
                        $fields = " ( " . $fields . " ) ";
                    }
                }
                if ($tempData != "") {
                    $tempData = " ( " . $tempData . " ) ";
                }

                $data == "" ? $data = $tempData : $data .= "," . $tempData;
            }
        }
        if ($fields != "" || $data != "") {
            $sqlData = "INSERT INTO " . $tbl . " $fields VALUES $data ";
            return mysql_query($sqlData);
            
        }
        return true;
    }
function sk_Update($tbl, $arrayData, $condition = '')
{
        $fields = "";
        $tagNotExecute = TAGNOTEXECUTE;
        while (list($key, $value) = each($arrayData)) {
            if (substr($value, 0, 3) != $tagNotExecute) {
                $fields .= $fields == "" ? "`" . $key . "` = '" . $value . "'" : ",`" . $key .
                    "` = '" . $value . "'";
            } else {
                $value = substr($value, 3, strlen($value));
                $fields .= $fields == "" ? "`" . $key . "` = " . $value . "" : ",`" . $key .
                    "` = " . $value . "";
            }

        }
        if ($fields != "") {
            $sqlData = "UPDATE " . $tbl . " SET $fields ";
            if ($condition != "") {
                $sqlData .= " WHERE " . $condition;
            }
            #echo $sqlData;
            return mysql_query($sqlData);
        }
        return true;
    }
	
function sk_Delete($tbl,$condition)
    {
        $sqlDelete = "DELETE  FROM $tbl WHERE $condition";
        return mysql_query($sqlDelete);
    }
	
function sk_GetLastId(){
    return mysql_insert_id();
}

function sk_NumRows($query){
	mysql_num_rows($query);
}

function sk_Mysql($sql=''){
    $query = mysql_query($sql) or die(mysql_error());
    return $query;
}

?>
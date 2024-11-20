<?php
function parse_line($line)//function for parsing the apache file
{
    $pattern = '/(\S+) (\S+) (\S+) 

\[([\w:\/]+\s[+\-]\d{4})\]

 "(\S+) (\S+) HTTP\/\d\.\d" (\d{3}) (\d+) "([^"]+)" "([^"]+)"/';
    preg_match($pattern, $line, $matches);
    if(!$matches)
    {
        return false;
    }//incase the log is not an actual log
    return [
        'ip' => $matches[1],
        'datetime' => $matches[4],
        'request_method' => $matches[5],
        'path' => $matches[6],
        'status' => $matches[7],
        'response_size' => $matches[8],
        'referrer' => $matches[9],
        'user_agent' => $matches[10],
        'website_identifier' => 'ADR' 
    ];
}

function analyze_logs($file_path, $unique_identifier)
{
    $page_accesses = [];
    $handle = fopen($file_path, "r");
    if($handle)
    {
        while(($line = fgets($handle)) !== false)
        {
            $data = parse_line($line);
            if($data && $data['website_identifier'] === $unique_identifier)
            {
                if(isset($page_accesses[$data['path']]))
                {
                    $page_accesses[$data['path']]++;
                }
                else
                {
                    $page_accesses[$data['path']] = 1;
                }
            }
        }
        fclose($handle);
    }//the case where I can open the file log
    else//the case where I cannot open the file log
    {
        echo "Error opening the file log";
    }

    return $page_accesses;
}

$file_path = '/var/log/apache2/';
$unique_identifier = 'plm'; 
$results = analyze_logs($file_path, $unique_identifier); 

echo "<h2>Page Accesses</h2>";
echo"<pre>";
print_r($results);
echo "</pre>";
?>

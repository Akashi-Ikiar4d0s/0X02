powershell -ExecutionPolicy Bypass -Command "& { param([string]$FilePath,[string]$Owner,[string]$Repo,[string]$GitHubToken,[string]$Branch='main'); [Net.ServicePointManager]::SecurityProtocol=[Net.SecurityProtocolType]::Tls12; $FileName=[System.IO.Path]::GetFileName($FilePath); $FileContent=[Convert]::ToBase64String([System.IO.File]::ReadAllBytes($FilePath)); $Url='https://api.github.com/repos/'+$Owner+'/'+$Repo+'/contents/'+$FileName; $Json='{\"message\":\"Adding '+$FileName+' via PowerShell\",\"content\":\"'+$FileContent+'\",\"branch\":\"'+$Branch+'\"}'; $HttpWebRequest=[System.Net.HttpWebRequest]::Create($Url); $HttpWebRequest.Method='PUT'; $HttpWebRequest.Headers.Add('Authorization', 'token '+$GitHubToken); $HttpWebRequest.Accept='application/vnd.github.v3+json'; $HttpWebRequest.ContentType='application/json'; $HttpWebRequest.UserAgent='Mozilla/5.0'; $Bytes=[System.Text.Encoding]::UTF8.GetBytes($Json); $HttpWebRequest.ContentLength=$Bytes.Length; $RequestStream=$HttpWebRequest.GetRequestStream(); $RequestStream.Write($Bytes,0,$Bytes.Length); $RequestStream.Close(); $HttpWebResponse=$HttpWebRequest.GetResponse(); $StreamReader=New-Object System.IO.StreamReader($HttpWebResponse.GetResponseStream()); $Response=$StreamReader.ReadToEnd(); $StreamReader.Close(); Write-Host 'Response from GitHub: '+$Response }"

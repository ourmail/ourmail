<?php

//Helper Functions

//This function prints a folder to the side navbar
function print_folder($folder,$label){
    $output="<li>\n<a href=\"dashboard.php?label=" . rawurlencode($label) . "&folder=" .rawurlencode($folder) . "\">" .$folder . "</a>\n</li>\n";
    echo $output;
}

//This function prints a mailbox to the side navbar. It call print_folder to print folders contained in a mailbox.
function print_mailbox($account){
    $label=$account['label'];
    //$username=$account['username'];

    echo "<li>\n<a>" .$label ."</a>\n<ul class=\"sidebar-brand\">\n";
    foreach($account['folders'] as $folder){
        print_folder($folder,$label);
    }       
    echo "</ul>\n</li>\n";
}

//This function prints all mailboxes
function print_all_mailboxes($accounts){
    foreach($accounts as $account){
        print_mailbox($account);
    }
}

//This function builds the imapinfo_object, which contains information about the users email accounts.
function buildImapInfo(&$imapinfo, &$ctxio){

    $lu=$ctxio->listUsers(array(
        'email' => USER_EMAIL
    ));
    if ($lu === false) {
        throw new exception("Unable to get the user.");
    }

    $lud = $lu->getData()[0];

    //Store User ID
    $usr_id=$lud['id'];
    $imapinfo['id']=$usr_id;
    $imapinfo['accounts']=array();

    //Iterate over mail accounts
    $mail_accounts=$lud['email_accounts'];
    foreach($mail_accounts as $maccount){

        $account=array();

        //Get Current Account Label
        $label=$maccount['label'];
        $username=$maccount['username'];

        //Store label
        $account['label']=$label;
        $account['username']=$username;
        $account['folders']=array();

        //Get mail account folders.
        $eaf=$ctxio->listEmailAccountFolders($usr_id, array(
            'label' => $label
        ));

        //Error checking for mail account folders
        if ($eaf === false) {
            throw new exception("Unable to fetch folders");
        } 

        $eafd=$eaf->getData();

        //Iterate over folders
        foreach($eafd as $folderdata){

            //Store Folders
            $folder=$folderdata['name'];
            array_push($account['folders'],$folder);
        }
        array_push($imapinfo['accounts'],$account);
    }
    var_dump($imapinfo);
}

// This function takes in a message object and prints it to the screen
function print_message($message){

$senderName=$message['addresses']['sender']['0']['name'];
$subject=$message['subject'];
$sendTimeSeconds=$message['sent_at'];
$sendDate=date('Y/m/d H:i:s', $sendTimeSeconds);

$message_html = <<<EOT
                        <table border="0" cellspacing="0" cellpadding="0" align="left" style="width:100%;margin:0 auto;background:#FFF;">
                            <tr>
                                <td colspan="5" style="padding:15px 0;">
                                    <h1 style="color:#000;font-size:24px;padding:0 15px;margin:0;">{$senderName}</h1>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:15px;">&nbsp;</td>
                                <td style="width:375px;">
                                    {$subject}
                                </td>
                                <td style="width:15px;">&nbsp;</td>
                                <td style="width:180px;padding:0 0 0 0;">
                                    {$sendDate}
                                </td>
                                <td style="width:15px;">&nbsp;</td>
                            </tr>
                        </table>
EOT;

echo $message_html;
}

// This function takes list of message objects and prints them all
function print_all_messages($msgsd){
    foreach($msgsd as $msg){
        print_message($msg);
    }
}

// This function fetches messages and prints them all.
function get_messages_and_print($label,$folder){

    global $ctxio;
    global $imapinfo;

    // Get Messages
    $msgs=$ctxio->listMessages($imapinfo['id'],array(
        'label' => $label,
        'folder' => $folder,
    ));
    if ($msgs === false) {
        throw new exception("Unable to fetch messages");
    }

    // Get messages Data
    $msgsd=$msgs->getData();
    print_all_messages($msgsd);
}

// This function fetches the new mailbox based on whats folder is selected by the user.
function refresh_mailbox(){
// FIXME. Do error checking for wrong variables passed.
    if (array_key_exists('label',$_GET) and array_key_exists('folder',$_GET)){
        $label=$_GET['label'];
        $folder=$_GET['folder'];
    } else {
        $label=$imapinfo['accounts']['0']['label'];
        $folder=$imapinfo['accounts']['0']['folders']['0'];
    }
    get_messages_and_print($label,$folder);
}

?>

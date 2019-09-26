<?php
namespace Gearserver\controller;

use Gearserver\controller;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class mail{

    protected $container;

    private $host = 'smtp.gmail.com';
    private $username = 'geargame30@eng.cmu.ac.th';
    private $password = 'geargame30';
    private $mail;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
        $this->mail = new PHPMailer(true);
        try{
            $this->mail->CharSet = "utf-8";
            $this->mail->SMTPDebug = 0;
            $this->mail->isSMTP();   
            $this->mail->Host = $this->host;
            $this->mail->SMTPAuth = true;
            $this->mail->Username = $this->username;
            $this->mail->Password = $this->password;
            $this->mail->SMTPSecure = 'tls';
            $this->mail->Port = 587;  

        }catch(Exception $err){
            $this->container->logger->error($err->getMessage());
        }
    }

    private function sends($emails){
        /*
         $recipients = array(
            'person1@domain.com' => 'Person One',
            'person2@domain.com' => 'Person Two',
                // ..
        );
        foreach($recipients as $email => $name) {
            $mail->AddAddress($email, $name);
        }      
         */
        
        // easy to troubleshooting
        $flag = false;
        foreach($emails as $email => $name){
            $this->container->logger->info("Mailer : try to send email to " . $email);
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $this->mail->addAddress($email,$name);
                $this->container->logger->info("Mailer : " . $email ." Added");
                $flag = true;
            }else{
                $this->container->logger->error("Mailer : " . $email . " is invalid");
            }
        }
        // if no one addAddress flag will be false
        if($flag){
            try{
                $this->mail->send();
                $this->logger->info("Mailer : Message has been sent!!!");
                return true;
            }catch(Exception $err){
                $this->logger->error($err->getMessage());
                return false;
            }
        }else{
            return false;
        }

    }

    private function bindContent($content){
        $Subject = empty($content['subject']) ? 'no-reply@Geargames30' : $content['subject'];
        $Body = empty($content['body']) ? 'Somethings wrong about content.' : $content['body'];
        try{
            
        }catch(Exception $err){
            $this->container->logger->error($err->getMessage());
        }
    }

}
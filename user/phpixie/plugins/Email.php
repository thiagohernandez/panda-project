<?php
namespace PHPixie;

/**
 * FTB's Email module for PHPixie
 *
 * nb. It's unfinished - I didn't do mail templates yet!
 *
 */
 
class Email extends \PHPixie\Plugin {
	

	/**
	 * Send an email
	 * 
	 * Input: an array with the following items in it
	 *
	 * 'to' - destination email address (obligatory, single address or array of addresses)
	 *
	 * 'from' - email address of sender (obligatory)
	 *
	 * 'subject' - Subject line for email
	 *
	 * 'cc' - email addresses for Carbon Copy (single address or array)
	 *
	 * 'bcc' - email addresses for Blind Carbon Copy (single address or array)
	 *
	 * The message body can be either plain text or HTML depending on the supplied field.
	 * You need to supply _one_ of the following:
	 *
	 * 'message' - text body for the message
	 *
	 * 'html' - HTML code for the message
	 *
	 */
	private function address_list($a) {
		if (is_array($a)) {
			return implode(',', $a);
		}
		else {
			return $a;
		}
	}
	public function send($params) {
		if (!empty($params['to']) && !empty($params['from'])) {
			$crlf = "\r\n";
			// Basic parameters - to/from
			$to = $this->address_list($params['to']);
			$headers = "From: ".$params['from'].$crlf;
			$subject = $params['subject'];
			if (strlen($subject)==0) {
				$subject = "(no subject given)";
			}
			else {
				// Does subject line need UTF-8?
				$s = html_entity_decode($subject);
				if ($s !== $subject) {
					// Yes, encode it
					$subject = '=?utf-8?B?'.base64_encode(utf8_encode($s)).'?=';
				}
			}
			// CC/BCC
			if (!empty($params['cc'])) {
				$headers .= 'CC: '.$this->address_list($params['cc']).$crlf;
			}
			if (!empty($params['bcc'])) {
				$headers .= 'BCC: '.$this->address_list($params['bcc']).$crlf;
			}
			// Look for either 'message' or 'html' and decide how to send the email
			$message = null;
			if (isset($params['message'])) {
				// Plain text message
				$message = $params['message'];
				$message = utf8_encode(html_entity_decode($message));
				$headers .= 'Content-Type: text/plain; charset=utf-8'.$crlf;
			}
			if (($message===null) || (strlen($message)==0)) {
				// HTML message
				$message = '(empty message)';
				if (isset($params['html'])) {
					$html = $params['html'];
					if (($html!==null) && (strlen($html)>0)) {
						$headers .= 'MIME-Version: 1.0'.$crlf;
						$headers .= 'Content-type:text/html;charset=UTF-8'.$crlf;
						$message = $html;
					}
				}
			}
			return mail($to, $subject, $message, $headers);
		}
		return false;
	}

}

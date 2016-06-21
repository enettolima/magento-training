<?php
/**
 * Created by PhpStorm.
 * User: enettolima
 * Date: 6/20/16
 * Time: 1:58 PM
 */

namespace Training\ReviewValidation\Plugin;


class ValidateUsernamePlugin
{
    public function afterValidate(\Magento\Review\Model\Review $review, $result){
        $username = $review->getData('nickname');
        if(strpos($username, '-')){
            if(!is_array($username)){
                $result = [];
            }
            $result[] = __("No dashes allowed in the review nickname.");
        }
        return $result;
    }
}
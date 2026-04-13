<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $fillable = ['site_name', 'site_logo', 'site_favicon', 'contact_email', 'contact_phone', 'contact_address', 'facebook_url', 'twitter_url', 'instagram_url', 'linkedin_url', 'description', 'meta_keywords', 'meta_description', 'meta_title', 'footer_text','logo_footer'];
}


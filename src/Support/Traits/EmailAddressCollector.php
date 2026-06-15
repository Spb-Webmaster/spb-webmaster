<?php

namespace Support\Traits;

use App\Models\Setting;

trait EmailAddressCollector
{
    public function emails(): array
    {
        $emails = [];

        $mailAdmin = env('MAIL_ADMIN', config('mail.from.address'));
        if ($mailAdmin) {
            $emails[] = $mailAdmin;
        }

        $extra = Setting::getGroup('settings')->data['emails'] ?? [];
        foreach ($extra as $row) {
            if (!empty($row['email'])) {
                $emails[] = trim($row['email']);
            }
        }

        return array_values(array_unique(array_filter($emails)));
    }
}

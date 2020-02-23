<?php

namespace App\prosvujusmev\EmailMessages\Repositories;

use App\prosvujusmev\EmailMessages\EmailMessage;

class EmailMessageRepository
{
    /**
     *  Creates First Information email message for course date from text
     * 
     *  @param \App\prosvujusmev\Courses\CourseDate $courseDate
     *  @param string $text
     *  @return \App\prosvujusmev\EmailMessages\EmailMessage
     */
    public function createFirstInformation(\App\prosvujusmev\Courses\CourseDate $courseDate, string $text): EmailMessage
    {
        return EmailMessage::create([
            'model_id' => $courseDate->id,
            'model_type' => \App\prosvujusmev\Courses\CourseDate::class,
            'type' => EmailMessage::TYPE_FIRST_INFORMATION,
            'data' => json_encode(['text' => $text]),
            'view' => EmailMessage::VIEW_FIRST_INFORMATION,
        ]);
    }

    /**
     *  Updates First Information email message for course date from text
     * 
     *  @param \App\prosvujusmev\Courses\CourseDate $courseDate
     *  @param string $text
     *  @return bool
     */
    public function updateFirstInformation(\App\prosvujusmev\Courses\CourseDate $courseDate, string $text): bool
    {
        $emailMessage = $this->getFirstInformation($courseDate);
        return $emailMessage->update([
            'data' => json_encode(['text' => $text]),
        ]);
    }

    /**
     *  Saves First information for course date
     * 
     *  @param \App\prosvujusmev\Courses\CourseDate $courseDate
     *  @return void
     */
    public function saveFirstInformation(\App\prosvujusmev\Courses\CourseDate $courseDate, string $text) 
    {
        if ($this->firstInformationExists($courseDate)) {
            $this->updateFirstInformation($courseDate, $text);
        } else {
            $this->createFirstInformation($courseDate, $text);
        }
    }

    /**
     *  Get first information for course date
     * 
     *  @param \App\prosvujusmev\Courses\CourseDate $courseDate
     *  @return mixed
     */
    public function getFirstInformation(\App\prosvujusmev\Courses\CourseDate $courseDate)
    {
        return \App\prosvujusmev\EmailMessages\EmailMessage::where('model_id', $courseDate->id)
            ->where('model_type', \App\prosvujusmev\Courses\CourseDate::class)
            ->where('type', \App\prosvujusmev\EmailMessages\EmailMessage::TYPE_FIRST_INFORMATION)
            ->first();
    }

    /**
     *  Determinates if first information exists for course date
     * 
     *  @param \App\prosvujusmev\Courses\CourseDate $courseDate
     *  @return bool
     */
    public function firstInformationExists(\App\prosvujusmev\Courses\CourseDate $courseDate): bool
    {
        return $this->getFirstInformation($courseDate) !== null;
    }

    /**
     *  Creates Final Information email message for course date from text
     * 
     *  @param \App\prosvujusmev\Courses\CourseDate $courseDate
     *  @param string $text
     *  @return \App\prosvujusmev\EmailMessages\EmailMessage
     */
    public function createFinalInformation(\App\prosvujusmev\Courses\CourseDate $courseDate, string $text): EmailMessage
    {
        return EmailMessage::create([
            'model_id' => $courseDate->id,
            'model_type' => \App\prosvujusmev\Courses\CourseDate::class,
            'type' => EmailMessage::TYPE_FINAL_INFORMATION,
            'data' => json_encode(['text' => $text]),
            'view' => EmailMessage::VIEW_FINAL_INFORMATION,
        ]);
    }

    /**
     *  Updates Final Information email message for course date from text
     * 
     *  @param \App\prosvujusmev\Courses\CourseDate $courseDate
     *  @param string $text
     *  @return bool
     */
    public function updateFinalInformation(\App\prosvujusmev\Courses\CourseDate $courseDate, string $text): bool
    {
        $emailMessage = $this->getFinalInformation($courseDate);
        return $emailMessage->update([
            'data' => json_encode(['text' => $text]),
        ]);
    }

    /**
     *  Saves Final information for course date
     * 
     *  @param \App\prosvujusmev\Courses\CourseDate $courseDate
     *  @return void
     */
    public function saveFinalInformation(\App\prosvujusmev\Courses\CourseDate $courseDate, string $text) 
    {
        if ($this->finalInformationExists($courseDate)) {
            $this->updateFinalInformation($courseDate, $text);
        } else {
            $this->createFinalInformation($courseDate, $text);
        }
    }

    /**
     *  Get final information for course date
     * 
     *  @param \App\prosvujusmev\Courses\CourseDate $courseDate
     *  @return mixed
     */
    public function getFinalInformation(\App\prosvujusmev\Courses\CourseDate $courseDate)
    {
        return \App\prosvujusmev\EmailMessages\EmailMessage::where('model_id', $courseDate->id)
            ->where('model_type', \App\prosvujusmev\Courses\CourseDate::class)
            ->where('type', \App\prosvujusmev\EmailMessages\EmailMessage::TYPE_FINAL_INFORMATION)
            ->first();
    }

    /**
     *  Determinates if final information exists for course date
     * 
     *  @param \App\prosvujusmev\Courses\CourseDate $courseDate
     *  @return bool
     */
    public function finalInformationExists(\App\prosvujusmev\Courses\CourseDate $courseDate): bool
    {
        return $this->getFinalInformation($courseDate) !== null;
    }
}
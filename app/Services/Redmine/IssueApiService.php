<?php

namespace App\Services\Redmine;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class IssueApiService
{
    /**
     * Synchronizes an issue with the Redmine API.
     *
     * @param mixed $issue The issue to be synchronized.
     * @throws Exception Thrown if there is an error in the synchronization process.
     * @return void
     */
    public static function syncIssue($issue)
    {
        $client = new Client();
        $headers = [
        'Content-Type' => 'application/json',
        'X-Redmine-API-Key' => 'dd47afec1184c56a16e9ac1102fcc1b73ae32f61'
        ];
        $body = `{
            "issue": {
                "is_private": "0",
                "project_id": "$issue->project_id",
                "tracker_id": "6",
                "subject": "$issue->subject",
                "description": "$issue->description",
                "status_id": "7",
                "priority_id": "3",
                "assigned_to_id": "",
                "fixed_version_id": "",
                "parent_issue_id": "",
                "start_date": "2020-07-08",
                "due_date": "2020-07-10",
                "estimated_hours": "",
                "done_ratio": "50",
                "custom_field_values": {
                "3": "2",
                "4": "4",
                "5": "2020-07-17",
                "7": "2020-08-08",
                "8": "messge to customer",
                "10": "Sut test 2",
                "12": [
                    "make storyboard",
                    "BA for UI correction (storyboard)",
                    "Wire Frame",
                    "create rule, policy",
                    "make requirement for correction",
                    ""
                ],
                "14": [
                    "Setting basecode",
                    "Check source code",
                    "UI correction",
                    "add UI Animation",
                    "Deeplink",
                    "Migration (Front-end / iOS -> Android)",
                    "Migration (Front-end / Hybrid -> Native)",
                    ""
                ],
                "15": [
                    "DB Query Programing",
                    "connect API",
                    "Connect 3rd party Interface  > Email",
                    ""
                ],
                "16": [
                    "design Correction > PSD",
                    "design Correction > Figma",
                    "design Correction > Zeplin",
                    ""
                ],
                "17": [
                    "AppDr GIT",
                    "GITHUB",
                    "Gitlab",
                    "Bitbucket",
                    ""
                ],
                "18": [
                    "HTML/CSS",
                    "Javascript",
                    "React",
                    "VueJS",
                    "Cordova",
                    "Angular",
                    ""
                ],
                "20": "4",
                "22": [
                    "Android",
                    "Mobile Web",
                    ""
                ],
                "23": "6"
                },
                "notes": ""
            }
        }`;
        $request = new Request('POST', 'https://redmine.appdr.com/issues.json', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        $result = $res->getBody();
    }
}
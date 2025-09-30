<?php
return [
    'Users' => [
        [
            'ID' => 1,
            'UniversityID' => '010556170',
            'USERNAME' => 'demo',
            'FIRST_NAME' => 'Demo',
            'LAST_NAME' => 'User',
            'EMAIL' => 'demo@example.edu',
            'PASSHASH' => password_hash('demo', PASSWORD_BCRYPT),
            'SALT' => '',
            'DATE_CREATED' => '2015-02-16 19:04:01',
            'DATE_OF_BIRTH' => '1993-12-12',
            'FORGOT' => '0',
            'PERMISSION' => 3,
            'ACTIVATION' => 'demo-activation-code',
            'Active' => 1,
            'NoShows' => 0,
            'NumRides' => 12,
            'Notes' => 'Demo administrator account for exploring the prototype.'
        ],
        [
            'ID' => 2,
            'UniversityID' => '010555170',
            'USERNAME' => 'driver',
            'FIRST_NAME' => 'Drew',
            'LAST_NAME' => 'Driver',
            'EMAIL' => 'driver@example.edu',
            'PASSHASH' => password_hash('driver', PASSWORD_BCRYPT),
            'SALT' => '',
            'DATE_CREATED' => '2015-03-02 17:53:02',
            'DATE_OF_BIRTH' => '1994-07-10',
            'FORGOT' => '0',
            'PERMISSION' => 2,
            'ACTIVATION' => 'driver-activation-code',
            'Active' => 1,
            'NoShows' => 0,
            'NumRides' => 0,
            'Notes' => 'Assigned to the afternoon campus loop.'
        ],
        [
            'ID' => 3,
            'UniversityID' => '010557170',
            'USERNAME' => 'student',
            'FIRST_NAME' => 'Sam',
            'LAST_NAME' => 'Student',
            'EMAIL' => 'student@example.edu',
            'PASSHASH' => password_hash('student', PASSWORD_BCRYPT),
            'SALT' => '',
            'DATE_CREATED' => '2015-03-10 19:43:34',
            'DATE_OF_BIRTH' => '1996-05-04',
            'FORGOT' => '0',
            'PERMISSION' => 1,
            'ACTIVATION' => 'student-activation-code',
            'Active' => 1,
            'NoShows' => 1,
            'NumRides' => 6,
            'Notes' => 'Requires front-seat accommodations.'
        ]
    ],
    'Schedules' => [
        [
            'Schedule_ID' => 1,
            'Driver_ID' => 2,
            'Day' => date('Y-m-d'),
            'Cart' => "Ol' Reliable",
            'Student_First' => 'Sam',
            'StudentLast' => 'Student',
            'Driver' => 'Drew Driver',
            'PickupTime' => '09:30',
            'DropTime' => '09:45',
            'PickupPoint' => 'HLTH',
            'DropPoint' => 'BELL',
            'BackupDriver' => 'Demo User'
        ],
        [
            'Schedule_ID' => 2,
            'Driver_ID' => 2,
            'Day' => date('Y-m-d'),
            'Cart' => "Ol' Reliable",
            'Student_First' => 'Alex',
            'StudentLast' => 'Anderson',
            'Driver' => 'No Driver',
            'PickupTime' => '11:15',
            'DropTime' => '11:35',
            'PickupPoint' => 'ARKU',
            'DropPoint' => 'JBHT',
            'BackupDriver' => 'No Backup'
        ],
        [
            'Schedule_ID' => 3,
            'Driver_ID' => 2,
            'Day' => date('Y-m-d', strtotime('+1 day')),
            'Cart' => 'Pegasus',
            'Student_First' => 'Jamie',
            'StudentLast' => 'Jordan',
            'Driver' => 'Drew Driver',
            'PickupTime' => '13:00',
            'DropTime' => '13:20',
            'PickupPoint' => 'MULN',
            'DropPoint' => 'KIMP',
            'BackupDriver' => 'Demo User'
        ]
    ],
    'DriverTimes' => [
        [
            'DriverID' => 2,
            'UniversityID' => '010555170',
            'FirstName' => 'Drew',
            'LastName' => 'Driver',
            'StartTime' => '08:00',
            'EndTime' => '12:00',
            'DaysOfWeek' => '11100'
        ],
        [
            'DriverID' => 2,
            'UniversityID' => '010555170',
            'FirstName' => 'Drew',
            'LastName' => 'Driver',
            'StartTime' => '13:00',
            'EndTime' => '17:00',
            'DaysOfWeek' => '11100'
        ]
    ],
    'StudentTimes' => [
        [
            'RideID' => 1,
            'UniversityID' => '010557170',
            'PickupPlace' => 'HLTH',
            'DropPlace' => 'BELL',
            'RideTime' => '09:30',
            'Day' => '11100'
        ],
        [
            'RideID' => 2,
            'UniversityID' => '010557170',
            'PickupPlace' => 'MULN',
            'DropPlace' => 'KIMP',
            'RideTime' => '13:30',
            'Day' => '00111'
        ]
    ],
    'Stops' => [
        [
            'ID' => 1,
            'Place' => 'HLTH',
            'FullName' => 'Health Center',
            'Address' => '123 Wellness Way',
            'City' => 'Fayetteville',
            'State' => 'AR',
            'ZipCode' => 72701,
            'Latitude' => 36.0687,
            'Longitude' => -94.1722
        ],
        [
            'ID' => 2,
            'Place' => 'BELL',
            'FullName' => 'Bell Engineering Center',
            'Address' => '1310 N. Dodge St.',
            'City' => 'Fayetteville',
            'State' => 'AR',
            'ZipCode' => 72701,
            'Latitude' => 36.0681,
            'Longitude' => -94.1746
        ],
        [
            'ID' => 3,
            'Place' => 'ARKU',
            'FullName' => 'Arkansas Union',
            'Address' => '435 N. Garland Ave.',
            'City' => 'Fayetteville',
            'State' => 'AR',
            'ZipCode' => 72701,
            'Latitude' => 36.0685,
            'Longitude' => -94.1740
        ],
        [
            'ID' => 4,
            'Place' => 'JBHT',
            'FullName' => 'J.B. Hunt Center',
            'Address' => '227 N. Harmon Ave.',
            'City' => 'Fayetteville',
            'State' => 'AR',
            'ZipCode' => 72701,
            'Latitude' => 36.0659,
            'Longitude' => -94.1739
        ],
        [
            'ID' => 5,
            'Place' => 'MULN',
            'FullName' => 'Mullins Library',
            'Address' => '365 N. McIlroy Ave.',
            'City' => 'Fayetteville',
            'State' => 'AR',
            'ZipCode' => 72701,
            'Latitude' => 36.0692,
            'Longitude' => -94.1710
        ],
        [
            'ID' => 6,
            'Place' => 'KIMP',
            'FullName' => 'Kimball Hall',
            'Address' => '790 W. Dickson St.',
            'City' => 'Fayetteville',
            'State' => 'AR',
            'ZipCode' => 72701,
            'Latitude' => 36.0680,
            'Longitude' => -94.1802
        ]
    ],
    'Carts' => [
        [
            'ID' => 1,
            'Nickname' => "Ol' Reliable",
            'Num_Seats' => 3,
            'MilesDriven' => 1230,
            'LastGasUp' => '2015-01-19',
            'LastMaintenance' => '2015-01-02',
            'Notes' => 'Needs maintenance 2015-07-02'
        ],
        [
            'ID' => 2,
            'Nickname' => 'Pegasus',
            'Num_Seats' => 4,
            'MilesDriven' => 875,
            'LastGasUp' => '2015-02-01',
            'LastMaintenance' => '2015-03-15',
            'Notes' => 'Equipped with weather enclosure.'
        ]
    ]
];

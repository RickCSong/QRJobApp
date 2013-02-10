'use strict';

define(
  [
    'bootstrapData'
  ],
  function(data) {
    return {
      folders: ["Inbox", "Later", "Sent", "Trash"],
      users: data.users,
      jobs: data.jobs,
      applications: data.applications,
      contacts: [
        {
          "id": "contact_342",
          "firstName": "Rick",
          "lastName": "Song",
          "phone": "214-986-1774",
          "email": "rickcsong@gmail.com", 
          "school": "Rice University"
        },
        {
          "id": "contact_377",
          "firstName": "Alex",
          "lastName": "Chiu",
          "phone": "214-240-8184",
          "email": "alexgchiu@gmail.com"
        },
        {
          "id": "contact_398",
          "firstName": "Hassaan",
          "lastName": "Markhiani",
          "phone": "214-240-8184",
          "email": "alexgchiu@gmail.com"
        }
      ],
    };
  }
);


# Setting Up Application Workflow Tool
1. Clone Repository
2. Run `composer install`
3. Create .env.php file with the following:

 ```php
 <?php
 return [
 	'DB_HOST' => 'db_host',
 	'DB_NAME' => 'db_name',
	'DB_USER' => 'db_user',
	'DB_PASSWORD' => 'db_pass',
 ];
 ```
4. Run `php artisan migrate`
5. Run `php artisan db:seed`
6. Make sure to configure your webserver to point to the `public/` directory of this application 
7. Access web application and login with credentials admin:password

# Application Features
## Users and Roles
The admin user, or anyone with the administrator role has the ability to create and edit roles and users. For auditing purposes users and roles cannot be deleted.

A single user can be assigned as the primary on a role.

### Roles
The application comes with four roles out of the box:
* Administrator
* Marketing
* Publisher
* Regulator

#### Role Matrix

|            Action | Administrator | Publisher | Marketing | Regulator |
|------------------:|:-------------:|:---------:|:---------:|:---------:|
| Create Users      | yes           | no        | no        | no        |
| Edit Users        | yes           | no        | no        | no        |
| View Users        | yes           | no        | no        | no        |
| Delete Users      | no            | no        | no        | no        |
| Create Roles      | yes           | no        | no        | no        |
| Edit Roles        | yes           | no        | no        | no        |
| View Roles        | yes           | no        | no        | no        |
| Delete Roles      | no            | no        | no        | no        |
| Create Releases   | yes           | yes       | no        | no        |
| Edit Releases     | yes           | yes       | no        | no        |
| View Releases     | yes           | yes       | yes       | yes       |
| Delete Releases   | yes           | yes       | no        | no        |
| Publish Releases  | yes           | yes       | no        | no        |
| Create Revisions  | yes           | yes       | no        | no        |
| Edit Revisions    | no            | no        | no        | no        |
| View Revisions    | yes           | yes       | yes       | yes       |
| Delete Revisions  | yes           | yes       | no        | no        |
| Approve Revisions | yes           | yes       | yes       | yes       |
### Test Accounts
The application comes with four test accounts out of the box:

| Purpose | Username | Password | Approval Password |
| --------|----------|----------|-------------------|
|Admin    |admin     | password | approve           |
|Marketing|marketing | password | approve           |
|Regulator|regulator | password | approve           |
|Publisher|publisher | password | approve           |

### Password Requirements
A password must meet the following requirements:
* must be at least 6 characters
* must contain at least 3 of the following:
 * captial letter
 * lowercase letter
 * special character
 * number

## Releases
Any user with the publisher role can create a release. This is the first step of the workflow process. Once a release is created, 
revisions which can contain any number of changes (under one URL) can be created.

The only requirement for creating a release is a name.

When a release is created, the status of that release is considered 'Pending'.

## Revisions
Once a release is created, any user with the publisher role can create a revision. A revision consists of the following:
* Name
* URL of production site for comparison - 'Live URL'
 * Must follow URL standard (http://)
 * Domain must match this application domain
* URL of page where changes are made - 'Approval URL'
 * Must follow URL standard (http://)
 * Domain must match this application domain
* Approval Requirements

When creating a revision, the publisher chooses which roles or users are required for approval. The ability to choose a role or a user allows the flexability of requiring 
specific users when needed.

### Approval
Once a revision is created, any user which fulfills the role requirement for a revision can approve it, which will fulfill that requirement, and any single user which was assigned to the approval can approve it.

Upon approval, every user is required to enter a second approval password.

In the case where a user fulfills both requirements ex: You choose the marketing role, and the user "Bob Marketing", it will fulfill only the most specific requirement, which would be the specific user. If a single user is chosen as an approval requirement, they can never fulfill the requirement as their role on that revision.

Once all the requirements have been fulfilled for a revision, that revision will be considered approved.

If all revisions in a release are considered approved, the publisher which created the release will be notified, and the status of the release will automatically change to 'Approved'.

Once the publisher has decided that all of the changes are ready to be published, they can publish the release by viewing the indivudal release which is linked in the notification they received.  

## Publishing
Upon publishing a script is run which makes a snapshot of the development site code and database, and promotes it to the production site.

## Notifications
### Revision Creation
Upon the creation of a revisions, the following will receive a notification:
* the publisher who created the revision
* the primary user of any role selected as an approval requirement
* any single user that was selected as an approval requirement

## Release Approval
When every approval requirement has been met for every revision under a release, the following will receive a notification:
* the publisher that created the release

## Release Creation
When a new release is created, the following will receive a notification:
* the publisher that created the release

# Putting it all together
Below is a high level overview of the entire process:
 1. Publisher creates release (Release considered Pending)
 2. Publisher creates revisions and selects approval requirements
 3. Users approve all revisions (Release considered Approved)
 4. Publisher reviews the approvals, and publishes the changes (Release considered Published)

Published releases are displayed in a second table below current releases, and display when they were published as well as the publisher which published the release.

#Known Issues/Caveats
* Deleting Users or Roles will cause issues when data is queried. Soft deleting is implemented on the database level for Users and Roles, however the querying functionality is not yet built.
* URLs in revisions must match the domain of this application. This is achieved using the vagrant configuration included in the agamatrix-box repository, or via the nginx configuration files 




# Admin Panel User Guide

## Quick Start Guide

### First Time Setup

1. **Login**: Go to `/admin/login` and enter your credentials
2. **Change Password**: Click "Change Password" in sidebar (bottom)
3. **Configure Settings**: Go to Settings → Update company info and email

### Essential Tasks

#### Update About Page
1. Sidebar → **About**
2. Click **Edit** on any section
3. Update content, images, or videos
4. Click **Update**

#### Add/Edit a Course
1. Sidebar → **Courses**
2. Click **Create New Course** or **Edit** existing
3. Fill in title, description, price, image
4. Click **Save**

#### Manage Bookings
1. Sidebar → **Bookings**
2. View all bookings
3. Click on booking to see details
4. Change status using dropdown

#### Update Settings
1. Sidebar → **Settings**
2. Update:
   - Company tagline
   - System email
   - Phone number
   - **Contact Form Email** (where contact form emails go)
   - Social media links
3. Click **Save Settings**

#### Add FAQ
1. Sidebar → **FAQs**
2. Click **Create New FAQ**
3. Enter question and answer
4. Click **Create FAQ**

#### Manage Users
1. Sidebar → **Users**
2. View, edit, or delete users
3. Toggle active status

### Important Settings

**Contact Form Email**: Settings → General Settings → "Contact Form Email"
- This is where contact form submissions are sent
- If blank, uses System Email

**Stripe Keys**: Settings → Payment Settings
- Required for payment processing
- Get from Stripe Dashboard

### Quick Tips

✅ Always click **Save** or **Update** after making changes  
✅ Use **Toggle Active** to show/hide content  
✅ Images should be under 2MB  
✅ Logout when finished  

---

## Table of Contents
1. [Getting Started](#getting-started)
2. [Dashboard](#dashboard)
3. [Content Management](#content-management)
4. [User Management](#user-management)
5. [Booking Management](#booking-management)
6. [Settings](#settings)
7. [Additional Features](#additional-features)
8. [Best Practices](#best-practices)
9. [Troubleshooting](#troubleshooting)

---

## Getting Started

### Accessing the Admin Panel

1. Navigate to your website's admin login page: `https://yourwebsite.com/admin/login`
2. Enter your admin credentials (provided by your developer)
3. Click "Login" to access the admin dashboard

### First Steps

- **Change Your Password**: Click "Change Password" in the bottom left sidebar to set a secure password
- **Explore the Dashboard**: Familiarize yourself with the navigation menu on the left side
- **Review Settings**: Go to Settings to configure your website's basic information

---

## Dashboard

The Dashboard provides an overview of your website's key metrics and recent activity.

**What you'll see:**
- Total bookings
- Recent bookings
- User statistics
- Quick access to common tasks

---

## Content Management

### 1. About Page Management

**Location**: Sidebar → About

**How to Update:**
1. Click "About" in the sidebar
2. Click "Edit" on any section you want to modify
3. Update the following fields:
   - **Title**: Section heading
   - **Content**: Main text content (supports rich text formatting)
   - **Image/Video**: Upload media files or use YouTube URLs
   - **Media Type**: Choose between Image or Video
   - **Order**: Control the display order (lower numbers appear first)
   - **Active Status**: Toggle to show/hide the section
4. Click "Update" to save changes

**Sections Available:**
- Hero Section (main banner)
- What We Offer
- Who We Are
- Other customizable sections

**Tips:**
- Use the rich text editor (CKEditor) for formatting text
- For YouTube videos, paste the full YouTube URL
- Keep images optimized (recommended: under 2MB)
- Use descriptive titles for better SEO

---

### 2. Courses Management

**Location**: Sidebar → Courses

**Creating a New Course:**
1. Click "Courses" in the sidebar
2. Click "Create New Course"
3. Fill in the required information:
   - **Title**: Course name
   - **Slug**: URL-friendly version (auto-generated from title)
   - **Description**: Detailed course information
   - **Price**: Course fee
   - **Duration**: Course length
   - **Image**: Course thumbnail
   - **Status**: Active/Inactive
4. Click "Create Course"

**Editing a Course:**
1. Go to Courses list
2. Click "Edit" on the course you want to modify
3. Update any fields
4. Click "Update"

**Deleting a Course:**
- Click "Delete" on any course (this action cannot be undone)

---

### 3. Trainings Management

**Location**: Sidebar → Trainings

**Creating a Training:**
1. Click "Trainings" → "Create New Training"
2. Fill in training details:
   - Basic information (title, description, price, etc.)
   - **Facilities**: Add training facilities with descriptions and images
   - **Amenities**: Add amenities with descriptions and media
3. Click "Create Training"

**Managing Facilities & Amenities:**
- Click "Edit" on any training
- Scroll to "Facilities" or "Amenities" section
- Click "Add New" to create items
- Use "Edit" or "Delete" to manage existing items

---

### 4. Consulting Sections Management

**Location**: Sidebar → Consulting Sections

**Managing Consulting Page Content:**
1. Click "Consulting Sections"
2. View all sections by type:
   - Hero
   - Overview
   - Services
   - Approach
   - Benefits
   - CTA (Call to Action)
3. Click "Create" to add a new section or "Edit" to modify existing ones

**Section Types:**
- **Hero**: Main banner section at the top
- **Overview**: Introduction text
- **Services**: Individual service offerings
- **Approach**: Step-by-step process
- **Benefits**: Key benefits list
- **CTA**: Call-to-action section

**Tips:**
- Use "Order" field to control display sequence
- Toggle "Active" to show/hide sections
- Services can have additional data items (bullets)

---

### 5. FAQs Management

**Location**: Sidebar → FAQs

**Adding a FAQ:**
1. Click "FAQs"
2. Click "Create New FAQ"
3. Fill in:
   - **Question**: The FAQ question
   - **Answer**: Detailed answer (supports rich text)
   - **Type**: Select "consulting" or other categories
   - **Display Order**: Number for sorting
   - **Status**: Active/Inactive
4. Click "Create FAQ"

**Managing FAQs:**
- Use "Edit" to update questions/answers
- Use "Delete" to remove FAQs
- Reorder by changing "Display Order" numbers

---

### 6. Bios Management

**Location**: Sidebar → Bios

**Updating Team Member Bios:**
1. Click "Bios"
2. Click "Edit" on the bio you want to update
3. Modify:
   - Name
   - Title/Position
   - Bio content (rich text)
   - Image
4. Click "Update"

---

### 7. Waivers Management

**Location**: Sidebar → Waivers

**Creating a Waiver:**
1. Click "Waivers" → "Create New Waiver"
2. Enter:
   - **Title**: Waiver name
   - **Content**: Waiver text (legal content)
   - **Status**: Active/Inactive
3. Click "Create Waiver"

**Note**: Waivers are shown to users during booking process

---

## User Management

### Managing Regular Users

**Location**: Sidebar → Users

**Viewing Users:**
- See all registered users in a table
- View user details: Name, Email, Phone, Status
- See user's booking history

**User Actions:**
- **Edit**: Update user information
- **View**: See detailed user profile and bookings
- **Toggle Active**: Activate/deactivate user accounts
- **Delete**: Remove user (use with caution)

**Creating a User:**
1. Click "Create New User"
2. Fill in user details
3. Set password
4. Choose active status
5. Click "Create User"

---

### Managing Subscribers

**Location**: Sidebar → Subscribers

**Newsletter Subscribers:**
- View all email subscribers
- See subscription date and status
- **Actions**:
  - Toggle Active: Activate/deactivate subscriptions
  - Delete: Remove subscriber

---

### Managing Admins (Super Admin Only)

**Location**: Sidebar → Admins (only visible to Super Admins)

**Admin Management:**
- Create new admin accounts
- Edit admin details
- Change admin passwords
- Delete admin accounts

**Note**: Only Super Admins can access this section

---

## Booking Management

**Location**: Sidebar → Bookings

### Viewing Bookings

**Booking List:**
- See all course bookings
- Filter by status: Pending, Confirmed, Completed, Cancelled
- View booking details: Customer, Course, Date, Amount

### Booking Details

**Click on any booking to see:**
- Customer information
- Course details
- Payment status
- Booking date and time
- Unique Booking ID (UID)

### Updating Booking Status

1. Click on a booking
2. Use the status dropdown
3. Select new status:
   - **Pending**: Initial booking state
   - **Confirmed**: Payment received
   - **Completed**: Training completed
   - **Cancelled**: Booking cancelled
4. Click "Update Status"

---

## Settings

**Location**: Sidebar → Settings

### General Settings

**Company Information:**
- **Tagline**: Company tagline (shown in footer)
- **System Email**: Main contact email (displayed on website)
- **Phone Number**: Contact phone number
- **Contact Form Email**: Email where contact form submissions are sent (if not set, uses System Email)

**How to Update:**
1. Go to Settings
2. Modify any field in "General Settings"
3. Click "Save Settings" at the bottom

### Social Media Links

**Add Your Social Media:**
- Facebook URL
- Instagram URL
- YouTube URL
- Twitter URL
- LinkedIn URL

**Note**: Leave blank if you don't have a social media account

### Payment Settings

**Stripe Configuration:**
- **Stripe Publishable Key**: Your Stripe public key (starts with `pk_`)
- **Stripe Secret Key**: Your Stripe secret key (starts with `sk_`)
- **Stripe Webhook Secret**: Webhook signing secret (starts with `whsec_`)

**How to Get Stripe Keys:**
1. Log in to [Stripe Dashboard](https://dashboard.stripe.com)
2. Go to Developers → API keys
3. Copy your keys
4. For webhooks: Go to Developers → Webhooks
5. Create endpoint pointing to: `https://yourwebsite.com/webhooks/stripe`

**Important**: Keep these keys secure and never share them publicly

---

## Additional Features

### Change Password

**Location**: Bottom of sidebar → "Change Password"

**How to Change:**
1. Click "Change Password"
2. Enter current password
3. Enter new password (minimum 8 characters)
4. Confirm new password
5. Click "Update Password"

### Logout

**Location**: Bottom of sidebar → "Logout"

Click "Logout" to securely exit the admin panel

---

## Best Practices

### Content Management Tips

1. **Regular Updates**: Keep content fresh and up-to-date
2. **Image Optimization**: Compress images before uploading (use tools like TinyPNG)
3. **SEO**: Use descriptive titles and keywords in content
4. **Backup**: Regularly backup important content
5. **Testing**: Preview changes on the frontend after updating

### Security Tips

1. **Strong Passwords**: Use complex passwords (mix of letters, numbers, symbols)
2. **Regular Password Changes**: Update passwords periodically
3. **Limited Access**: Only give admin access to trusted personnel
4. **Logout**: Always logout when finished, especially on shared computers

### Content Guidelines

1. **Consistency**: Maintain consistent tone and style across all pages
2. **Clarity**: Write clear, concise content
3. **Images**: Use high-quality, relevant images
4. **Links**: Ensure all links work correctly
5. **Mobile-Friendly**: Test content on mobile devices

---

## Troubleshooting

### Common Issues

**Can't Login:**
- Verify you're using the correct URL: `/admin/login`
- Check username and password
- Contact your developer if issues persist

**Images Not Uploading:**
- Check file size (should be under 2MB)
- Verify file format (JPG, PNG, GIF supported)
- Check internet connection

**Changes Not Showing:**
- Clear browser cache (Ctrl+F5 or Cmd+Shift+R)
- Check if content is set to "Active"
- Verify you clicked "Save" or "Update"

**Email Not Sending:**
- Check Settings → Contact Form Email is configured
- Verify email server settings (contact developer)
- Check spam/junk folder

### Getting Help

If you encounter issues not covered in this guide:
1. Check the error message (if any)
2. Review this guide again
3. Contact your website developer
4. Provide screenshots of the issue

---

## Quick Reference

### Navigation Menu (Left Sidebar)

- **Dashboard**: Overview and statistics
- **Courses**: Manage training courses
- **Bookings**: View and manage bookings
- **Users**: Manage user accounts
- **Subscribers**: Newsletter subscribers
- **Waivers**: Legal waiver documents
- **Bios**: Team member biographies
- **About**: About page content
- **FAQs**: Frequently asked questions
- **Consulting Sections**: Consulting page content
- **Trainings**: Training programs
- **Settings**: Website configuration
- **Admins**: Admin user management (Super Admin only)

### Common Actions

- **Create**: Add new content
- **Edit**: Modify existing content
- **Delete**: Remove content (usually permanent)
- **View**: See detailed information
- **Toggle Active**: Show/hide content
- **Save/Update**: Apply changes

---

## Contact & Support

For technical support or questions about using the admin panel, please contact your website developer.

**Remember**: 
- Always backup before making major changes
- Test changes on a staging site if available
- Keep login credentials secure
- Logout when finished

---

*Last Updated: January 2026*

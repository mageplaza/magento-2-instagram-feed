# Magento 2 Instagram Feed Extension
[Instagram Feed by Mageplaza](http://www.mageplaza.com/magento-2-instagram-feed/) is a supportive module which allows integrating Instagram images to Magento 2 website. This trendy extension enables you to place eye-catching Instagram images block to any page of your site, which can effectively draw customers' attention and bring a modern well-updated look to online stores.

## 1. Documentation
- [Installation guide](https://www.mageplaza.com/install-magento-2-extension/)
- [User guide](https://docs.mageplaza.com/instagram-feed/index.html)
- [Introduction page](http://www.mageplaza.com/magento-2-instagram-feed/)
- [Contribute on Github](https://github.com/mageplaza/magento-2-instagram-feed)
- [Get Support](https://github.com/mageplaza/magento-2-instagram-feed/issues)


## 2. FAQs

**Q: I got error: Mageplaza_Core has been already defined**

A: Read solution [here](https://github.com/mageplaza/module-core/issues/3)

**Q: On which page of my website can Instagram Feed is displayed?**

A: On any position that you want. Basically, there is not any restriction for place to show Instagram Feed. Admins can select any specific page such as Homepage, Product Listing Page, Product Page, or any CMS pages depending on their particular purposes.

**Q: How many images can be seen from the Instagram Feed on the storefront?**

A: You can easily set the number of images to display on backend. The maximum number is 20 images.

**Q: In which order the Instagram Feed will be displayed?**

A: Store owner can quickly sort the photos from Instagram photo library, based on one of specific criteria as most recent, most liked, most commented, or random.

**Q: Besides the image, is there any image information that can be seen on the Instagram Feed?**

A: With Instagram Feed, it is possible to set the number of Likes and Comments be displayed. Customer can easily see the visibility and popularity of the images. 

**Q: What if a visitor feel interested in a single image displayed on Instagram Feed?**

A: If a customer is interested in an image, they can simply click on that image on the Instagram block. A popup will automatically show up, display the big size version of that selected picture. 

**Q: Will Instagram Feed be responsive with mobile device?**

A: This block can properly work with both mobile, tablet, and PC device.


## 3. How to install Instagram Feed extension for Magento 2

Install via composer (recommend): Run the following command in Magento 2 root folder:

```
composer require mageplaza/module-instagram-feed
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```


## 4. Highlight Features

### Display Instagram Images anywhere on site 

Instagram Feed by Mageplaza support store admin in updating trendy eye-catching Instagram images on any specific pages on your store site.

Admins can easily create Instagram Widget then embed Instagram block on the homepage, product listing page, product page or any CMS pages, based on their specific purposes. 

This flexibility allows store owners to easily place the high-quality and good-looking Instagram Images to any locations on their beloved store site. Attractive images appearing on an appropriate position will probably appeal customers and accordingly contribute to your conversion rate. 

![Imgur](https://i.imgur.com/SMuVbVs.png)

### Sorting image function 
One of the most noticeable functions of Instagram Feed is that the store owner can quickly sort the photos from Instagram photo library, based on specific criteria, which are:

- Most recent images 
- Most liked images
- Most commented images
- Randomly displayed images

As a result, the appropriate images can easily be sorted out then displayed quickly on the store site. 

![Imgur](https://i.imgur.com/NQp8NtK.png)

### Various available photo layouts

Instagram images can be flexibly featured, thanks to the various options of layouts. This can help store admin design Instagram block to be suitable with the other blocks, page dimensions, and content display. The three main options can be set as follows:

- Single Row: The images are arranged to be displayed in only one row. This option is suitable to small available space on the store site.
- Multiple Rows: The images will be displayed in multiple rows. This choice is appropriate when the available space is wide, and the store owner wants to impress the visual communication on their site.
- Optimized Image: This layout has high displaying flexibility for all image sizes. Its displaying possibility mostly suits with Instagram images in different sizes.

![Imgur](https://i.imgur.com/JMD1pjY.png)

### Show the number of Likes and Comments

To effectively convince customers, Instagram Feed enable displaying the number of Likes and Comments on every image.

The customers tend to feel more interested in the images which can gain more social visibility and concern. Showing numbers of likes and comments is a good way to present your Instagram Photos' social interaction and make the store site become more interactive than ever.

![Imgur](https://i.imgur.com/AspYo33.png)

### Instagram Popup 

Popup can also be enabled, with Instagram Feed module, to feature the more beautiful look of your store site. It can be done easily and quickly only after a one-click setting from the backend.

On the storefront, customers can take a more detailed look to any Instagram image after they click on, the image will appear bigger on the displaying popup after. It makes stores look professional and is possible to considerably enhance customer experience.

![Imgur](https://i.imgur.com/z6di7ws.png)

## 5. More features

### Description for the Instagram Block
Easily set the title and description for the Instagram Block 

### Image Resolution 
3 options for view resolution: Standard, Low, Thumbnail 

### Set the number of photos
Set the limitation for the number of displayed images 

### Multi-devices responsiveness
Be well responsive with both desktop and mobile devices.


## 6. Full Featurea List

### For store admins

#### General
- Enable/disable the extension 
- Insert client ID, client secret, redirect_uri, authorization code

#### Display 
- Set the number of photos limitation
- Sort images by different criteria
- Optional images layout
- Display the number of likes and comments 
- Display a popup when the customer clicking on an image 

#### Instagram Widget 
- Be able to create Instagram widget
- Customize the widget title, description, store view, and sort order for the widget 
- Possible to add layout updates to show Instagram widget on 

### For customers
- Be well updated about the store most interesting images
- Notice the most liked/ commented/ recent photos of stores with ease
- Directly link to the targeted Instagram when customer clicking on the images 



## 7. User guide
From the **Admin Panel**, go to `Store > Settings > Configuration > MAGEPLAZA EXTENSIONS > Instagram Feed`

![Imgur](https://i.imgur.com/uAJv4ma.png)

### Configuration 
#### 1.1 General 


![Imgur](https://i.imgur.com/f85J6r8.png)

- **Enable**: Select `Yes` to enable the function of Instagram Feed
- **Client ID**: Insert the Instagram ID that you want to display pictures on feed
- **Client Secret**: Insert Client Secret of the application
- **Creating Instagram API guideline**: see [Here](https://docs.mageplaza.com/social-login-m2/how-to-configure-instagram-api.html)




#### 1.2 Display

![Imgur](https://i.imgur.com/caojC1a.png)

- **Total number of photos**
  - Insert the number of pictures that will be presented on feed
  - The maximum value for the number of pictures is 20
  
- **Sort by**

![Imgur](https://i.imgur.com/QULZOEr.png)

  - *Sort by = Most recent*: Show from latest to oldest
  - *Sort by = Most liked*: Show from most liked to least liked
  - *Sort by = Most commented*: Show from most commented to least commented
  - *Sort by = Random*: Show randomly

`Notice`: The pictures displayed on your site are selected according to your configuration in the Total number of photos field firstly, before being sorted by one of the orders such as Most recent, Most liked, Most commented, Random. For instance, if you insert 8 for the Total number of photos, 8 latest pictures will be taken out first, then that 8 latest ones be respectively shown on Instagram Feed based on your Sort by setting.

- **Layout**

![Imgur](https://i.imgur.com/epLTBuo.png)

- *Layout = Single Row*: Display pictures on a single row
- *Layout = Multiple Rows*: Display pictures on more than one rows
  - **Number of rows**:
    - Insert the number of rows to show Instagram pictures
    - If you leave it blank, the default number will be 2
- *Layout = Optimized image*: Show the images with the optimized quality.


- **Image resolutions**

![Imgur](https://i.imgur.com/Z0EVKY5.png)

  - *Image resolutions = Standard*: Display images with the standard resolution quality
  - *Image resolutions = Low*: Display images limited resolution quality
  - *Image resolutions = Thumbnail*: Display images in thumbnail format

- **Show number of Likes/ Comments**: Select `Yes` to display the number of Likes and Comments of the post simultaneously

- **Show pop-up**: Select `Yes` to show a popup when clicking on the image.


### 2. Widget

#### How to add Widget in Instagram Feed?

- **Step 1**: Select the Type
- **Step 2**: Configure the Storefront Properties section
- **Step 3**: Configure Widget Options to display images of the Instagram Feed

##### Step 1: Select the Type

- On the **Panel Admin**, go to `Content > Elements > Widgets`
- From the upper-right corner of **Widgets** workplace, hit the **Add Widget** button.
- In the **Settings** section:
   - Choose **CMS Static Block** for **Type** option.
   - Select your current theme that you are using in the **Design Theme** section.
   - Click on the **Continue** button.

![Imgur](https://i.imgur.com/nfIuJSY.png)

##### Step 2: Configure the Storefront Properties section

- Go to the **Storefront Properties** section,
  - Enter the **Widget Title** for the internal reference.
  - Assign the block on any store view you want to apply the block, by selecting in the **Assign to Store View field**
  - Set a value for the **Sort Order** option, if many blocks are placed at the same container. The lower **Sort Order** value, the higher is the position on Instagram block. For instance, the block will be at the top if the provided value is zero.

![Imgur](https://i.imgur.com/TGMPExO.png)

- In **Layout Updates** section, you can click **Add Layout Update** to set the layout.
  - In the **Display on** field, select the [category](https://www.mageplaza.com/kb/how-to-create-a-new-category-in-magento-2.html), [product](https://www.mageplaza.com/kb/how-create-simple-product-magento-2.html), or [page](https://www.mageplaza.com/kb/how-to-add-a-new-cms-page-magento-2.html) where the block will be shown. 
  - If you would like to set the block to a specific page, you need to choose Page you want the block to display and set **Container** as the specific position of the page that the block appears.

![Imgur](https://i.imgur.com/Gsgk9SD.png)

##### Step 3: Configure Widget Options to display images of the Instagram Feed

- **Title**: Insert the Title for Instagram Images, which can be seen from the frontend interface
- **Description**: Insert the description for images to show on frontend
- **Design** 

![Imgur](https://i.imgur.com/oTjNkpx.png)

  - *Design = Use Config*: Use design in Instagram Feed configuration section  
  - *Design = Custom*: Admin configure image displaying right on the frontend 
- **Total number of photos**
  - Insert the number of images shown on Instagram Feed
  - The maximum number of images is 20
- **Sort by**

![Imgur](https://i.imgur.com/DSDJ3pl.png)

  - *Sort by = Most recent*: Show from latest to oldest
  - *Sort by = Most liked*: Show from most liked to least liked
  - *Sort by = Most commented*: Show from most commented to least commented
  - *Sort by = Random*: Show randomly
- **Notice**: The pictures displayed on your site are selected according to your configuration in the **Total number of photos** field firstly, before being sorted by one of the orders such as **Most recent, Most liked, Most commented, Random**. For instance, if you insert **8** for **Total number of photos**, 8 latest pictures will be taken out first, then that 8 latest ones be respectively shown on Instagram Feed based on your Sort by setting.

- **Layout**

![Imgur](https://i.imgur.com/hxYR2w7.png)

  - *Layout = Single Row*: Display pictures on a single row
  - *Layout = Multiple Rows*: Display pictures on more than one rows
    - Number of rows
      - Insert the number of rows to show Instagram pictures
      - If you leave it blank, the default number will be 2
  - *Layout = Optimized image*: Show the images with the optimized quality.
  
- **Image resolutions**

![Imgur](https://i.imgur.com/sT4rbL4.png)

  - *Image resolutions = Standard*: Display images with the standard resolution quality
  - *Image resolutions = Low*: Display images limited resolution quality
  - *Image resolutions = Thumbnail*: Display images in thumbnail format
  
- **Show number of Likes/ Comments**: Select Yes to display the number of Likes and Comments of the post simultaneously
- **Show pop-up**: Select Yes to show a popup when clicking on the image.





//
//  TestTabBarController.m
//  testTab
//
//  Created by Rick Song on 2/9/13.
//  Copyright (c) 2013 Rick Song. All rights reserved.
//

#import "TopBarController.h"
#import "JobViewController.h"
#import <ZXingWidgetController.h>
#import <QRCodeReader.h>
#import "JobApplyView.h"
#import "BBCell.h"
#import <QuartzCore/QuartzCore.h>

//Keys used in the plist file to read the data for the table
#define KEY_TITLE @"title"
#define KEY_IMAGE_NAME @"image_name"
#define KEY_IMAGE @"image"

@interface TopBarController ()

@end

@implementation TopBarController

@synthesize bgImageView = _bgImageView;
@synthesize contentView = _contentView;
@synthesize tabImage = _tabImage;

@synthesize appliedView = _appliedView;
@synthesize settingsView = _settingsView;

//@synthesize mTableView = _mTableView;
@synthesize mDataSource = _mDataSource;

- (void)viewDidLoad
{
    [super viewDidLoad];
    
    [self setupCustomTabBar];
}

- (void)setupCustomTabBar
{
    [self loadDataSource];
    
    // background nav bar
    self.bgImageView = [[UIImageView alloc] initWithImage:[UIImage imageNamed:@"navbar.png"]];
    self.bgImageView.frame = CGRectMake(0, 0, 320, 63);
    [self.view addSubview:self.bgImageView];
    
    self.contentView = [[UIView alloc] initWithFrame:CGRectMake(0, 5, 640, 63)];
    [self.view addSubview:self.contentView];
    
    // sliding tab image
    self.tabImage = [[UIImageView alloc] initWithImage:[UIImage imageNamed:@"tabSelect.png"]];
    self.tabImage.frame = CGRectMake(176, 4, 48, 63);
    [self.contentView addSubview:self.tabImage];
    
    // make custom tab buttons (transparent with white symbol overlay)
    [self.contentView addSubview:[self makeScanButton]];
    [self.contentView addSubview:[self makeAppliedButton]];
    [self.contentView addSubview:[self makeSettingsButton]];
    [self.contentView addSubview:[self makeLogoutButton]];
    
    // make applied views
    self.appliedView = [[BBTableView alloc] initWithFrame:CGRectMake(0, 63, self.view.frame.size.width, self.view.frame.size.height-63) style:UITableViewCellSeparatorStyleNone];
    self.appliedView.backgroundColor = [UIColor whiteColor];
    self.appliedView.separatorColor = [UIColor clearColor];
    [self.appliedView setEnableInfiniteScrolling:NO];
    [self.appliedView setContentAlignment:eBBTableViewContentAlignmentLeft];
    [self.appliedView setDelegate:self];
    [self.appliedView setDataSource:self];
    
    // make settings view
    self.settingsView = [[UIView alloc] initWithFrame:CGRectMake(self.view.frame.size.width, 63, self.view.frame.size.width, self.view.frame.size.height-63)];
    self.settingsView.backgroundColor = [UIColor whiteColor];
    
    // add applied view
    [self.view addSubview:self.appliedView];
    [self.view sendSubviewToBack:self.appliedView];
    [self.view addSubview:self.settingsView];
    [self.view sendSubviewToBack:self.settingsView];
}

- (UIButton *)makeScanButton
{
    UIButton *button = [UIButton buttonWithType:UIButtonTypeCustom];
    button.frame = CGRectMake(0, 0, 68, 54);
    button.tag = 0;
    [button setBackgroundImage:[UIImage imageNamed:@"buttonScan.png"] forState:UIControlStateNormal];
    [button addTarget:self action:@selector(scanTapped:) forControlEvents:UIControlEventTouchUpInside];
    return button;
}

- (UIButton *)makeAppliedButton
{
    UIButton *button = [UIButton buttonWithType:UIButtonTypeCustom];
    button.frame = CGRectMake(176, 0, 48, 54);
    button.tag = 1;
    [button setBackgroundImage:[UIImage imageNamed:@"buttonApplied.png"] forState:UIControlStateNormal];
    [button addTarget:self action:@selector(updateTabImage:) forControlEvents:UIControlEventTouchUpInside];
    return button;
}

- (UIButton *)makeSettingsButton
{
    UIButton *button = [UIButton buttonWithType:UIButtonTypeCustom];
    button.frame = CGRectMake(224, 0, 48, 54);
    button.tag = 2;
    [button setBackgroundImage:[UIImage imageNamed:@"buttonSettings.png"] forState:UIControlStateNormal];
    [button addTarget:self action:@selector(updateTabImage:) forControlEvents:UIControlEventTouchUpInside];
    return button;
}

- (void)updateTabImage:(id)sender
{
    int buttonIndex = [sender tag];
    CGRect targetRect = CGRectMake(128 + buttonIndex*48, 4, 48, 63);
    [UIView beginAnimations:nil context:NULL];
    [UIView setAnimationDuration:0.3];
    [UIView setAnimationCurve:UIViewAnimationCurveEaseInOut];
    [self.tabImage setFrame:targetRect];
    if (buttonIndex == 1)
    {
        [self.appliedView setFrame:CGRectMake(0, 63, self.view.frame.size.width, self.view.frame.size.height-63)];
        [self.settingsView setFrame:CGRectMake(self.view.frame.size.width, 63, self.view.frame.size.width, self.view.frame.size.height-63)];
    }
    else
    {
        [self.appliedView setFrame:CGRectMake(-self.view.frame.size.width, 63, self.view.frame.size.width, self.view.frame.size.height-63)];
        [self.settingsView setFrame:CGRectMake(0, 63, self.view.frame.size.width, self.view.frame.size.height-63)];
    }
    [UIView commitAnimations];
}

- (UIButton *)makeLogoutButton
{
    UIButton *button = [UIButton buttonWithType:UIButtonTypeCustom];
    button.frame = CGRectMake(274, 0, 48, 54);
    button.tag = 3;
    [button setBackgroundImage:[UIImage imageNamed:@"buttonLogout.png"] forState:UIControlStateNormal];
    [button addTarget:self action:@selector(logoutTapped:) forControlEvents:UIControlEventTouchUpInside];
    return button;
}

- (void)logoutTapped:(id)sender
{
    // handle logouts, probably pop a modal view controller asking for confirmation
}

- (void)scanTapped:(id)sender
{
    ZXingWidgetController *widController = [[ZXingWidgetController alloc] initWithDelegate:self showCancel:YES OneDMode:NO showLicense:NO];
    
    NSMutableSet *readers = [[NSMutableSet alloc ] init];
    
    QRCodeReader* qrcodeReader = [[QRCodeReader alloc] init];
    [readers addObject:qrcodeReader];
    widController.readers = readers;
    [self presentViewController:widController animated:YES completion:nil];
}

#pragma mark -
#pragma mark ZXingDelegateMethods

- (void)zxingController:(ZXingWidgetController*)controller didScanResult:(NSString *)result
{
    JobApplyView *jobView = [[JobApplyView alloc] initWithFrame:CGRectMake(0, 0, self.view.frame.size.width, self.view.frame.size.height)];
    jobView.alpha = 0.0f;
    jobView.jDelegate = self;
    [jobView getJobInfo:result];
    [self dismissViewControllerAnimated:YES completion:^{
        [UIView beginAnimations:@"curlup" context:nil];
        [UIView setAnimationDelegate:self];
        [UIView setAnimationDuration:.5];
        [self.view addSubview:jobView];
        jobView.alpha = 1.0f;
        [self.view bringSubviewToFront:jobView];
        [UIView commitAnimations];
    }];
}

- (void)zxingControllerDidCancel:(ZXingWidgetController*)controller
{
    [self dismissViewControllerAnimated:YES completion:nil];
}

#pragma mark UITableViewDelegate Methods
- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{
    return  [self.mDataSource count];
}

// Row display. Implementers should *always* try to reuse cells by setting each cell's reuseIdentifier and querying for available reusable cells with dequeueReusableCellWithIdentifier:
// Cell gets various attributes set automatically based on table (separators) and data source (accessory views, editing controls)

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    static NSString *test = @"table";
    BBCell *cell = (BBCell*)[tableView dequeueReusableCellWithIdentifier:test];
    if( !cell )
    {
        cell = [[BBCell alloc] initWithStyle:UITableViewCellStyleValue1 reuseIdentifier:test];
    }
    NSDictionary *info = [self.mDataSource objectAtIndex:indexPath.row];
    [cell setCellTitle:[info objectForKey:KEY_TITLE]];
    [cell setIcon:[info objectForKey:KEY_IMAGE]];
    
    return cell;
}



//read the data from the plist and alos the image will be masked to form a circular shape
- (void)loadDataSource
{
    NSMutableArray *dataSource = [[NSMutableArray alloc] initWithContentsOfFile:[[NSBundle mainBundle] pathForResource:@"data" ofType:@"plist"]];
    
    self.mDataSource = [[NSMutableArray alloc] init];
    
    dispatch_async(dispatch_get_global_queue(DISPATCH_QUEUE_PRIORITY_DEFAULT, 0), ^{
        
        //generate image clipped in a circle
        for( NSDictionary * dataInfo in dataSource )
        {
            NSMutableDictionary *info = [dataInfo mutableCopy];
            UIImage *image = [UIImage imageNamed:[info objectForKey:KEY_IMAGE_NAME]];
            UIImage *finalImage = nil;
            UIGraphicsBeginImageContext(image.size);
            {
                CGContextRef ctx = UIGraphicsGetCurrentContext();
                CGAffineTransform trnsfrm = CGAffineTransformConcat(CGAffineTransformIdentity, CGAffineTransformMakeScale(1.0, -1.0));
                trnsfrm = CGAffineTransformConcat(trnsfrm, CGAffineTransformMakeTranslation(0.0, image.size.height));
                CGContextConcatCTM(ctx, trnsfrm);
                CGContextBeginPath(ctx);
                CGContextAddEllipseInRect(ctx, CGRectMake(0.0, 0.0, image.size.width, image.size.height));
                CGContextClip(ctx);
                CGContextDrawImage(ctx, CGRectMake(0.0, 0.0, image.size.width, image.size.height), image.CGImage);
                finalImage = UIGraphicsGetImageFromCurrentImageContext();
                UIGraphicsEndImageContext();
            }
            [info setObject:finalImage forKey:KEY_IMAGE];
            
            [self.mDataSource addObject:info];
        }
        
        dispatch_async(dispatch_get_main_queue(), ^{
            [self.appliedView reloadData];
            // [self setupShapeFormationInVisibleCells];
        });
    });
}

- (void)updateDataForCompany:(NSString *)company ForTitle:(NSString *)title
{
    NSMutableDictionary *info = [NSMutableDictionary dictionary];
    [info setValue:[NSString stringWithFormat:@"%@ %@", company, title] forKey:@"title"];
    [info setValue:[NSString stringWithFormat:@"%@.jpg", company] forKey:@"image_name"];
    UIImage *image = [UIImage imageNamed:[info objectForKey:KEY_IMAGE_NAME]];
    UIImage *finalImage = nil;
    UIGraphicsBeginImageContext(image.size);
    {
        CGContextRef ctx = UIGraphicsGetCurrentContext();
        CGAffineTransform trnsfrm = CGAffineTransformConcat(CGAffineTransformIdentity, CGAffineTransformMakeScale(1.0, -1.0));
        trnsfrm = CGAffineTransformConcat(trnsfrm, CGAffineTransformMakeTranslation(0.0, image.size.height));
        CGContextConcatCTM(ctx, trnsfrm);
        CGContextBeginPath(ctx);
        CGContextAddEllipseInRect(ctx, CGRectMake(0.0, 0.0, image.size.width, image.size.height));
        CGContextClip(ctx);
        CGContextDrawImage(ctx, CGRectMake(0.0, 0.0, image.size.width, image.size.height), image.CGImage);
        finalImage = UIGraphicsGetImageFromCurrentImageContext();
        UIGraphicsEndImageContext();
    }
    [info setObject:finalImage forKey:KEY_IMAGE];
    
    [self.mDataSource addObject:info];
    [self.appliedView reloadData];
}

@end

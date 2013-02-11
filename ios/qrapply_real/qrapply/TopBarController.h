//
//  TestTabBarController.h
//  testTab
//
//  Created by Rick Song on 2/9/13.
//  Copyright (c) 2013 Rick Song. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "ZXingWidgetController.h"
#import "BBTableView.h"
#import "JobApplyView.h"

@interface TopBarController : UIViewController <ZXingDelegate, UITableViewDataSource, UITableViewDelegate, JobApplyDelegate>

@property (nonatomic, strong) UIImageView *bgImageView;
@property (nonatomic, strong) UIView *contentView;
@property (nonatomic, strong) UIImageView *tabImage;

//@property (nonatomic, strong) UIView *appliedView;
@property (nonatomic, strong) UIView *settingsView;

@property (nonatomic, strong) BBTableView *appliedView;
@property (nonatomic, strong) NSMutableArray *mDataSource;

- (void)updateDataForCompany:(NSString *)company ForTitle:(NSString *)title;

@end

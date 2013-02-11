//
//  JobViewController.h
//  qrapply
//
//  Created by Hassaan Markhiani on 2/10/13.
//  Copyright (c) 2013 Hassaan Markhiani. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface JobViewController : UIViewController

@property (nonatomic, strong) UIScrollView *scrollView;
@property (nonatomic, strong) UITextView *companyName;
@property (nonatomic, strong) UITextView *jobTitle;
@property (nonatomic, strong) UITextView *jobDescription;
@property (nonatomic, strong) UIButton *cancelButton;
@property (nonatomic, strong) UIButton *applyButton;

@end

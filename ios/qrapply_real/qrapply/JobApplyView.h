//
//  JobApplyView.h
//  qrapply
//
//  Created by Hassaan Markhiani on 2/10/13.
//  Copyright (c) 2013 Hassaan Markhiani. All rights reserved.
//

#import <UIKit/UIKit.h>

@protocol JobApplyDelegate
- (void)updateDataForCompany:(NSString *)company ForTitle:(NSString *)title;
@end

@interface JobApplyView : UIView <NSURLConnectionDataDelegate>

@property (nonatomic, strong) NSString *jobID;
@property (nonatomic, strong) UIScrollView *scrollView;
@property (nonatomic, strong) UITextView *companyName;
@property (nonatomic, strong) UITextView *jobTitle;
@property (nonatomic, strong) UITextView *jobDescription;
@property (nonatomic, strong) UIButton *cancelButton;
@property (nonatomic, strong) UIButton *applyButton;
@property (nonatomic, strong) NSMutableData *searchResultsData;

@property (nonatomic, assign) id <JobApplyDelegate> jDelegate;

- (void)getJobInfo:(NSString *)jobLink;


@end

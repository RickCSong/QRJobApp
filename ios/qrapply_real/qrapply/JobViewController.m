//
//  JobViewController.m
//  qrapply
//
//  Created by Hassaan Markhiani on 2/10/13.
//  Copyright (c) 2013 Hassaan Markhiani. All rights reserved.
//

#import "JobViewController.h"
#import "QuartzCore/CALayer.h"

@interface JobViewController ()

@end

@implementation JobViewController

@synthesize companyName = _companyName;
@synthesize jobTitle = _jobTitle;
@synthesize jobDescription = _jobDescription;
@synthesize cancelButton = _cancelButton;
@synthesize applyButton = _applyButton;

- (id)init
{
    self = [super init];
    if (self) {
        // Custom intialization
    }
    return self;
}

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
    }
    return self;
}

- (void)viewDidLoad
{
    [super viewDidLoad];
	// Do any additional setup after loading the view.
    // add stuff
    CGRect frame = CGRectMake(self.view.frame.size.width*0.05, self.view.frame.size.height*0.05, self.view.frame.size.width*0.9, self.view.frame.size.height*0.9);
    
    self.scrollView = [[UIScrollView alloc] initWithFrame:frame];
    self.scrollView.backgroundColor = [UIColor colorWithPatternImage:[UIImage imageNamed:@"kindajean.png"]];
    self.scrollView.layer.cornerRadius = 5.0f;
    self.scrollView.layer.shadowColor = [UIColor blackColor].CGColor;
    self.scrollView.layer.shadowOffset = CGSizeMake(0, 0);
    self.scrollView.layer.shadowOpacity = 0.85;
    self.scrollView.layer.shadowRadius = 5.0f;
    self.scrollView.layer.shouldRasterize = YES;
    self.scrollView.clipsToBounds = NO;
    [self.view addSubview:self.scrollView];
    
    self.companyName = [[UITextView alloc] initWithFrame:CGRectMake(frame.size.width*0.05, frame.size.height*0.05, frame.size.width*0.9, frame.size.height*0.15)];
    self.companyName.text = @"Google";
    [self.companyName setFont:[UIFont fontWithName:@"Helvetica-Bold" size:36.0f]];
    self.companyName.backgroundColor = [UIColor clearColor];
    self.companyName.editable = NO;
    [self.scrollView addSubview:self.companyName];
    
    self.jobTitle = [[UITextView alloc] initWithFrame:CGRectMake(frame.size.width*0.05, frame.size.height*0.2, frame.size.width*0.9, frame.size.height*0.2)];
    self.jobTitle.text = @"Software Engineer Intern";
    [self.jobTitle setFont:[UIFont fontWithName:@"Helvetica" size:30.0f]];
    self.jobTitle.backgroundColor = [UIColor clearColor];
    self.jobTitle.editable = NO;
    [self.scrollView addSubview:self.jobTitle];
    
    self.jobDescription = [[UITextView alloc] initWithFrame:CGRectMake(frame.size.width*0.05, frame.size.height*0.4, frame.size.width*0.9, frame.size.height*0.4)];
    self.jobDescription.text = @"Make stuff for Google";
    [self.jobDescription setFont:[UIFont fontWithName:@"Helvetica-Light" size:24.0f]];
    self.jobDescription.backgroundColor = [UIColor clearColor];
    self.jobDescription.editable = NO;
    [self.scrollView addSubview:self.jobDescription];
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

@end

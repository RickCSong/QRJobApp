//
//  JobApplyView.m
//  qrapply
//
//  Created by Hassaan Markhiani on 2/10/13.
//  Copyright (c) 2013 Hassaan Markhiani. All rights reserved.
//

#import "JobApplyView.h"
#import "QuartzCore/CALayer.h"

@implementation JobApplyView

@synthesize jDelegate = _jDelegate;
@synthesize jobID = _jobID;
@synthesize scrollView = _scrollView;
@synthesize companyName = _companyName;
@synthesize jobTitle = _jobTitle;
@synthesize jobDescription = _jobDescription;
@synthesize cancelButton = _cancelButton;
@synthesize applyButton = _applyButton;
@synthesize searchResultsData = _searchResultsData;

- (id)initWithFrame:(CGRect)frame
{
    self = [super initWithFrame:frame];
    if (self) {
        // Initialization code
        self.backgroundColor = [UIColor colorWithRed:0 green:0 blue:0 alpha:0.5];
        self.jobID = @"";
        
        // frame
        CGRect frame = CGRectMake(self.frame.size.width*0.05, self.frame.size.height*0.05, self.frame.size.width*0.9, self.frame.size.height*0.7);
    
        // scroll view
        self.scrollView = [[UIScrollView alloc] initWithFrame:frame];
        self.scrollView.backgroundColor = [UIColor colorWithPatternImage:[UIImage imageNamed:@"kindajean.png"]];
        self.scrollView.layer.cornerRadius = 5.0f;
        self.scrollView.layer.shouldRasterize = YES;
        self.clipsToBounds = YES;
        [self addSubview:self.scrollView];
        
        // compny name
        self.companyName = [[UITextView alloc] initWithFrame:CGRectMake(frame.size.width*0.05, frame.size.height*0.05, frame.size.width*0.9, frame.size.height*0.15)];
        self.companyName.text = @"Company Name";
        [self.companyName setFont:[UIFont fontWithName:@"Helvetica-Bold" size:20.0f]];
        self.companyName.backgroundColor = [UIColor clearColor];
        self.companyName.editable = NO;
        self.companyName.scrollEnabled = NO;
        self.companyName.userInteractionEnabled = NO;
        [self.scrollView addSubview:self.companyName];
        
        // job title
        self.jobTitle = [[UITextView alloc] initWithFrame:CGRectMake(frame.size.width*0.05, frame.size.height*0.2, frame.size.width*0.9, frame.size.height*0.15)];
        self.jobTitle.text = @"Job Title";
        [self.jobTitle setFont:[UIFont fontWithName:@"Helvetica" size:16.0f]];
        self.jobTitle.backgroundColor = [UIColor clearColor];
        self.jobTitle.editable = NO;
        self.jobTitle.userInteractionEnabled = NO;
        self.jobTitle.scrollEnabled = NO;
        [self.scrollView addSubview:self.jobTitle];
        
        // job description
        self.jobDescription = [[UITextView alloc] initWithFrame:CGRectMake(frame.size.width*0.05, frame.size.height*0.35, frame.size.width*0.9, frame.size.height*0.4)];
        self.jobDescription.text = @"Job Description";
        [self.jobDescription setFont:[UIFont fontWithName:@"Helvetica" size:12.0f]];
        self.jobDescription.backgroundColor = [UIColor clearColor];
        self.jobDescription.editable = NO;
        self.jobDescription.scrollEnabled = NO;
        self.jobDescription.userInteractionEnabled = NO;
        [self.scrollView addSubview:self.jobDescription];
        frame = CGRectMake(self.jobDescription.frame.origin.x, self.jobDescription.frame.origin.y, self.jobDescription.frame.size.width, self.jobDescription.contentSize.height);
        self.jobDescription.frame = frame;
        
        // content size for scroll view
        self.scrollView.contentSize = CGSizeMake(self.scrollView.contentSize.width, self.jobDescription.frame.origin.y+self.jobDescription.frame.size.height);
        
        // cancel button
        self.cancelButton = [UIButton buttonWithType:UIButtonTypeCustom];
        self.cancelButton.frame = CGRectMake(self.frame.size.width*0.75-27, self.frame.size.height*0.875-27, 54, 54);
        [self.cancelButton setBackgroundImage:[UIImage imageNamed:@"responseno.png"] forState:UIControlStateNormal];
        [self.cancelButton addTarget:self action:@selector(exit:) forControlEvents:UIControlEventTouchUpInside];
        [self addSubview:self.cancelButton];
        
        // apply button
        self.applyButton = [UIButton buttonWithType:UIButtonTypeCustom];
        self.applyButton.frame = CGRectMake(self.frame.size.width*0.25-32, self.frame.size.height*0.875-27, 64, 54);
        [self.applyButton setBackgroundImage:[UIImage imageNamed:@"responseyes.png"] forState:UIControlStateNormal];
        [self.applyButton addTarget:self action:@selector(apply:) forControlEvents:UIControlEventTouchUpInside];
        [self addSubview:self.applyButton];
    }
    return self;
}

- (void)exit:(id)sender
{
    [UIView beginAnimations:@"removeWithEffect" context:nil];
    [UIView setAnimationDuration:0.5f];
    self.alpha = 0.0f;
    [UIView commitAnimations];
    [self performSelector:@selector(removeFromSuperview) withObject:nil afterDelay:0.5f];
}

- (void)apply:(id)sender
{
    // apply
    NSMutableURLRequest *request = [NSMutableURLRequest requestWithURL:[NSURL URLWithString:[NSString stringWithFormat:@"http://573t.localtunnel.com/apply?user=4&job=%@&timestamp=0", self.jobID]]];
    [NSURLConnection connectionWithRequest:request delegate:self];
    
    [self.jDelegate updateDataForCompany:self.companyName.text ForTitle:self.jobTitle.text];
    
    // exit
    [self exit:sender];
}

- (void)getJobInfo:(NSString *)jobLink
{
    // save jobID
    self.jobID = jobLink;
    
    // get job data
    NSMutableURLRequest *request = [NSMutableURLRequest requestWithURL:[NSURL URLWithString:[NSString stringWithFormat:@"http://573t.localtunnel.com/jobinfo?job=%@", self.jobID]]];
    [NSURLConnection connectionWithRequest:request delegate:self];
}

/*
// Only override drawRect: if you perform custom drawing.
// An empty implementation adversely affects performance during animation.
- (void)drawRect:(CGRect)rect
{
    // Drawing code
}
*/

#pragma mark NSURLConnnection Delegate Methods

// TODO: Handle errors and bad responses in a sensible way.
- (void)connection:(NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response
{
    self.searchResultsData = [[NSMutableData alloc] initWithCapacity:1024];
}

- (void)connection:(NSURLConnection *)connection didFailWithError:(NSError *)error
{
}

- (void)connection:(NSURLConnection *)connection didReceiveData:(NSData *)data
{
    [self.searchResultsData appendData:data];
}

- (void)connectionDidFinishLoading:(NSURLConnection *)connection
{
    // TODO: handle error checking, after updating, id class checking
    NSError *error = nil;
    id JSONObject = [NSJSONSerialization JSONObjectWithData:self.searchResultsData options:NSJSONReadingAllowFragments error:&error];
    if (!JSONObject)
    {
        return;
    }
    
    id data = [JSONObject objectForKey:@"Job"];
    if (![data isKindOfClass:[NSDictionary class]])
    {
        return;
    }
    
    self.companyName.text = [data objectForKey:@"company"];
    self.jobTitle.text = [data objectForKey:@"title"];
    self.jobDescription.text = [data objectForKey:@"description"];
    CGRect frame = CGRectMake(self.jobDescription.frame.origin.x, self.jobDescription.frame.origin.y, self.jobDescription.frame.size.width, self.jobDescription.contentSize.height);
    self.jobDescription.frame = frame;
}


@end

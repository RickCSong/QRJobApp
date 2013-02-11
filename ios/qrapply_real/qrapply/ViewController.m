//
//  ViewController.m
//  qrapply
//
//  Created by Hassaan Markhiani on 2/9/13.
//  Copyright (c) 2013 Hassaan Markhiani. All rights reserved.
//

#import "ViewController.h"
#import "TopBarController.h"

@interface ViewController ()

@property (nonatomic) TopBarController *tbController;

@end

@implementation ViewController

@synthesize tbController = _tbController;

- (void)viewDidLoad
{
    [super viewDidLoad];
    
    self.view.backgroundColor = [UIColor colorWithRed:(174/255.0) green:(37/255.0) blue:(30/255.0) alpha:1.0];
    self.tbController = [[TopBarController alloc] init];
    self.tbController.view.backgroundColor = [UIColor whiteColor];
}

- (void)viewDidAppear:(BOOL)animated
{
    [self presentViewController:self.tbController animated:YES completion:nil];
}

- (void)viewDidUnload
{
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

@end

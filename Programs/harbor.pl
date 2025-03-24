#!/usr/bin/perl
use strict;
use warnings;
use Tk;

# Create Main Window
my $mw = MainWindow->new;
$mw->title("Simple Calculator");

# Entry Field
my $entry = $mw->Entry(-font => "Arial 16")->pack(-padx => 10, -pady => 10);

# Function to Update Entry
sub button_click {
    my ($val) = @_;
    my $current = $entry->get();
    $entry->delete(0, 'end');
    $entry->insert('end', $current . $val);
}

# Function to Evaluate Expression
sub calculate {
    my $expr = $entry->get();
    my $result = eval $expr; 
    $entry->delete(0, 'end');
    $entry->insert('end', defined $result ? $result : "Error");
}

# Function to Clear Entry
sub clear_entry {
    $entry->delete(0, 'end');
}

# Buttons Layout
my @buttons = (
    [ "7", "8", "9", "/" ],
    [ "4", "5", "6", "*" ],
    [ "1", "2", "3", "-" ],
    [ "0", ".", "=", "+" ]
);

foreach my $row (@buttons) {
    my $frame = $mw->Frame()->pack();
    foreach my $btn (@$row) {
        my $b = $frame->Button(
            -text    => $btn,
            -font    => "Arial 14",
            -width   => 5,
            -height  => 2,
            -command => sub {
                if ($btn eq "=") { calculate(); }
                else { button_click($btn); }
            }
        )->pack(-side => "left", -padx => 5, -pady => 5);
    }
}

# Clear Button
$mw->Button(
    -text    => "Clear",
    -font    => "Arial 14",
    -width   => 22,
    -command => \&clear_entry
)->pack(-pady => 10);

MainLoop;
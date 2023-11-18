<?php

namespace App\Filament\Resources;

use App\Enums\ApplicationStatus;
use App\Enums\ReleaseStatus;
use App\Filament\Resources\PaymentResource\Pages;
use App\Models\CustomerApplication;
use App\Models\Unit;
use App\Models\Payment;
use Illuminate\Support\Facades\Blade;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Filament\Notifications;
use Illuminate\Database\Eloquent\Model;

use App\Filament\Pages\TestPage;
use App\Filament\Resources\CustomerApplicationResource\Pages\ViewCustomerApplication;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function getApplicationInformation(): Forms\Components\Component
    {
        return Forms\Components\Group::make([
            Forms\Components\Section::make("Customer Application's Information")

                    ->schema([
                        Forms\Components\TextInput::make('application_firstname')
                                ->columnSpan(3)
                                ->disabled()
                                ->label('First name'),
                        Forms\Components\TextInput::make('application_lastname')
                                ->columnSpan(3)
                                ->disabled()
                                ->label('Last name'),
                        Forms\Components\TextInput::make('application_unit')
                                ->columnSpan(6)
                                ->disabled()
                                ->label('Unit'),
                        Forms\Components\TextInput::make('application_unit_price')
                                ->columnSpan(6)
                                ->disabled()
                                ->label('Price'),
                    ])
                    ->columns(6)
        ]);
    }

    public static function getPaymentDetails(): Forms\Components\Component
    {
        return Forms\Components\Group::make([
                Forms\Components\Placeholder::make("Payment is")
                    ->content(function (Forms\Get $get):string{
                        $dp = CustomerApplication::query()
                            ->where('id', $get('customer_application_id'))
                            ->first();
                        if($dp != null){
                            if($dp->unit_monthly_amort == null){
                                return "Down Payment";
                            }
                            return "Monthly Payment";
                        }
                        return "";
                    })
                    ->columnSpan(2),
                Forms\Components\TextInput::make('due_date')
                        ->columnSpan(6)
                        ->readOnly()
                        ->hidden(function(string $operation){
                            if($operation == "edit"){
                                return true;
                            }
                        }),
                Forms\Components\TextInput::make('payment_amount')
                        ->live()
                        ->columnSpan(2)
                        ->required()
                        ->readOnly(function (Forms\Get $get):bool{
                            $dp = CustomerApplication::query()
                                ->where('id', $get('customer_application_id'))
                                ->first();
                            if($dp != null){
                                return false;
                            }
                            return true;
                        }),
                Forms\Components\Select::make('payment_status')
                        ->live()
                        ->options([
                            'advance' => 'Advance',
                            'current' => 'Current',
                            'overdue' => 'Overdue',
                            'diligent' => 'Diligent',
                        ])
                        ->columnSpan(2)
                        ->required(),
                Forms\Components\Select::make('payment_type')->label('Payment Type:')
                        ->options([
                            "field" => "Field",
                            "office" => "Office",
                            "bank" => "Bank",
                        ])
                        ->columnSpan(6)
                        ->required(true),
        ])
        ->columns(6);
    }


    public static function getApplicationDetails(): Forms\Components\Component
    {
        return Forms\Components\Group::make([
                Forms\Components\Select::make('customer_application_id')
                ->searchable()
                ->columnSpan(1)
                ->getSearchResultsUsing(fn (string $search): array => CustomerApplication::getUnreleasedApplications($search)->get()->pluch('id', 'applicant_firstname'. "applicant_lastname")->toArray())
                ->getOptionLabelUsing(fn ($value): ?string => CustomerApplication::find($value)?->id)
                ->required()
                ->live()
                ->afterStateUpdated(
                    function($state, Forms\Set $set, ?Model $record){
                        $application = CustomerApplication::query()
                                ->where("id", $state)
                                ->first();
                        $set('due_date', "");
                        $set('payment_amount', "");
                        $set('application_firstname',  "");
                        $set('customer_application_group',  "");
                        $set('application_unit',  "");
                        $set('application_unit',  "");
                        $set('application_unit_price',  "");
                        if($application != null){
                            if($application->application_status == ApplicationStatus::APPROVED_STATUS ->value
                                    && $application->release_status == ReleaseStatus::UN_RELEASED->value)
                            {
                                dd("Down Payment");
                            }else if($application->application_status == ApplicationStatus::ACTIVE_STATUS->value){
                                // dd("Amort. Payment");
                                $state->payment_amount = $application->unit_monthly_amort;
                                dd($record->payment_amount);
                            }
                            $due_date = $application->due_date;
                            $today = Carbon::today();
                            
                            $amort_fin = $application->unit_monthly_amort;
                            $set('due_date', $due_date);
                            $set('payment_amount', $amort_fin);
                            $set('application_firstname', $application->applicant_firstname);
                            $set('application_lastname', $application->applicant_lastname);
                            $set('application_unit', $application->unitModel->model_name);
                            $set('application_unit_price', $application->unitModel->price);
                            
                            $delinquent = $today->copy()->addDays(30);
                            
                            $parsed_date = Carbon::createFromFormat(config('app.date_format'), $due_date);
                            
                            $is_advance = $today->lt($parsed_date);
                            $is_current = $today->eq($parsed_date);
                            $is_overdue = $today->gt($parsed_date) && $today->lt($delinquent);
                            $is_delinquent = $today->gt($delinquent);
    
                            if($today->lessThan($parsed_date)){
                                $set('payment_status', 'advance');
                            }
                            elseif($today->equalTo($parsed_date)){
                                $set('payment_status', 'current');
                            }
                            elseif($today->greaterThan($parsed_date) && $today->lessThan($delinquent)){
                                $set('payment_status', 'overdue');
                            }
                            elseif($today->greaterThan($delinquent)){
                                $set('payment_status', 'delinquent');
                            }
                        }
                    }
                ),
        ])
        ->columns(2);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make([
                    PaymentResource::getApplicationDetails()
                            ->columnSpan(3),
                    PaymentResource::getApplicationInformation()
                            ->columnSpan(3),  
                ])
                ->columns(3)
                ->columnSpan(3),
                PaymentResource::getPaymentDetails()
                        ->columnSpan(3),
            ])
            ->columns(6);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                    Tables\Columns\TextColumn::make('id')
                            ->label('ID')
                            ->searchable(),
                    Tables\Columns\TextColumn::make('customerApplication.applicant_firstname')
                            ->label('First Name')
                            ->searchable(),
                    Tables\Columns\TextColumn::make('payment_amount')
                            ->label('Payment Amount')
                            ->money('php'),
                    Tables\Columns\TextColumn::make('created_at')
                            ->label('Date Paid')
                            ->dateTime('d-M-Y'),
            ])
            ->defaultSort('created_at', 'desc')

            ->defaultPaginationPageOption(5)
            ->filters([
                Tables\Filters\Filter::make('created_at')
            ])
            
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('pdf') 
                ->label('Print')
                ->color('success')
                ->action(function (Model $record) {
                    return response()->streamDownload(function () use ($record) {
                        echo Pdf::loadHtml(
                            Blade::render('monthly_amort_receipt', ['record' => $record, 'date_today' => Carbon::now()->format('d-M-Y')])
                        )->stream();
                    }, $record->id . '.pdf');
                }), 
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->requiresConfirmation(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
            'view-customer-application' => ViewCustomerApplication::route('/{record}'),
        ];
    }
}

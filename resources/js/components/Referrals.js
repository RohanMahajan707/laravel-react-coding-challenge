import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import { ReactMultiEmail } from "react-multi-email";
import "react-multi-email/style.css";
import '../../css/referral.css';

function Referrals() {
    const referalCode = register_url + '?refer=' + code;
    const [copyText, setCopyText] = useState("Copy Link");
    const [sendText, setSendText] = useState("Send");
    const [sendDisabled, setSendDisabled] = useState(true);
    const [inviteEmail, setInviteEmail] = useState([]);
    const [formError, setFormError] = useState('');
    const [formSuccess, setFormSuccess] = useState('');

    const handleCopyLink = () => {
        navigator.clipboard.writeText(referalCode)
        setCopyText('Copied')
    }
    const handleSubmit = (e) => {
        e.preventDefault()
        setFormError('');
        setFormSuccess('');
        if (inviteEmail.length == 0) {
            setFormError('Please enter atleast one email');
            return false;
        }

        setSendText('Please Wait..')
        setSendDisabled(true)

        //insert invites
        axios.post('/invites', {
            emailList: inviteEmail,
        }).then(function (response) {
            if (response.data.status == true) {
                setFormError('')
                setFormSuccess(response.data.message)
                setInviteEmail([])
                setSendDisabled(true)
            }
            else {
                setFormError(response.data.message)
                setFormSuccess('')
                setSendDisabled(false)
            }
            setSendText('Send')

        }).catch(function (error) {
            console.log(error)
        });
    }
    return (
        <div className="container">
            <div className="row">
                <div className="col-lg-10 mt-5 mx-auto">
                    <div className="row">
                        <div className="col-lg-12">
                            <p>Your Invite Link</p>
                            <span className="referral_link">
                                {referalCode}
                            </span>
                        </div>
                        <div className="col-lg-12">
                            <button className='btn btn-dark btn-sm mt-3' onClick={handleCopyLink}>{copyText}</button>
                        </div>
                    </div>
                    <div className="row mt-5">
                        <div className="col-lg-8">
                            <form onSubmit={handleSubmit}>
                                <div className='form-group'>
                                    <label htmlFor="email_invite">Email your invite</label>

                                    <ReactMultiEmail style={{ height: "auto" }}
                                        placeholder="Input your Email Address"
                                        emails={inviteEmail}
                                        onChange={(_emails) => {
                                            setFormError('');
                                            setInviteEmail(_emails);

                                            if (_emails.length > 0)
                                                setSendDisabled(false)
                                            else
                                                setSendDisabled(true)
                                        }}
                                        getLabel={(email, index, removeEmail) => {
                                            return (
                                                <div data-tag key={index}>
                                                    {email}
                                                    <span data-tag-handle onClick={() => removeEmail(index)}>
                                                        ×
                                                    </span>
                                                </div>
                                            );
                                        }}
                                    />

                                    <span className="text-danger">{formError}</span>
                                    <span className="text-success">{formSuccess}</span>
                                </div>
                                <button className='btn btn-primary btn-sm' disabled={sendDisabled}>{sendText}</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    );
}

export default Referrals;

if (document.getElementById('referral_div')) {
    ReactDOM.render(<Referrals />, document.getElementById('referral_div'));
}
